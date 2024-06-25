<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = 'SB-Mid-server-stFdxsmP6eTyM9qSaLcjCCva';
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        Config::$is3ds = env('MIDTRANS_IS_3DS');

        Config::$curlOptions[CURLOPT_SSL_VERIFYHOST] = 0;
        Config::$curlOptions[CURLOPT_SSL_VERIFYPEER] = 0;
        Config::$curlOptions[CURLOPT_HTTPHEADER] = [];
    }

    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Please login to continue.');
        }

        $cartItems = Cart::where('user_id', Auth::id())->get();
        $totalProductAmount = 0;

        foreach ($cartItems as $item) {
            $totalProductAmount += $item->product->selling_price * $item->quantity;
        }

        if ($totalProductAmount <= 0) {
            return redirect('collections')->with('error', 'No items in cart to checkout.');
        }

        return view('frontend.checkout.index', compact('totalProductAmount'));
    }

    public function placeOrder(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'pincode' => 'required|numeric',
            'address' => 'required',
        ]);

        $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        if ($carts->isEmpty()) {
            return redirect('collections')->with('error', 'No items in cart to checkout.');
        }

        // Group cart items by seller_id
        $cartGroups = $carts->groupBy(function ($item) {
            return $item->product->user_id;
        });

        $totalProductAmount = 0;
        // Midtrans payment processing
        $params = [
            'transaction_details' => [
                'order_id' => 'ORD' . Str::random(10),
                'gross_amount' => $totalProductAmount,
            ],
            'customer_details' => [
                'first_name' => $validated['fullname'],
                'last_name' => '',
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'billing_address' => [
                    'first_name' => $validated['fullname'],
                    'last_name' => '',
                    'email' => $validated['email'],
                    'phone' => $validated['phone'],
                    'address' => $validated['address'],
                ],
                'shipping_address' => [
                    'first_name' => $validated['fullname'],
                    'last_name' => '',
                    'email' => $validated['email'],
                    'phone' => $validated['phone'],
                    'address' => $validated['address'],
                ],
            ],
            'item_details' => $carts->map(function ($cartItem) {
                return [
                    'id' => $cartItem->product_id,
                    'price' => $cartItem->product->selling_price,
                    'quantity' => $cartItem->quantity,
                    'name' => $cartItem->product->name,
                ];
            })->toArray(),
        ];

        $snapToken = Snap::getSnapToken($params);

        foreach ($cartGroups as $sellerId => $items) {
            $order = Order::create([
                'user_id' => Auth::id(),
                'seller_id' => $sellerId,
                'tracking_no' => 'ORD' . Str::random(10),
                'fullname' => $validated['fullname'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'pincode' => $validated['pincode'],
                'address' => $validated['address'],
                'status_message' => 'in progress',
                'payment_mode' => 'Midtrans Gateway', // Use the selected payment mode
                'payment_id' => $snapToken
            ]);

            foreach ($items as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'product_color_id' => $cartItem->product_color_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->selling_price,
                ]);
                $totalProductAmount += $cartItem->product->selling_price * $cartItem->quantity;
            }

            Notification::create([
                'user_id' => $sellerId,
                'message' => 'New order received, please check your order page in seller dashboard.',
                'type' => 'new_order',
                'status' => 'unread',
            ]);
        }

        Cart::where('user_id', Auth::id())->delete();

        return view('frontend.checkout.payment', compact('snapToken', 'totalProductAmount'));
    }

    public function updatePaymentMethod(Request $request)
{
    $serverKey = config('midtrans.server_key');
    $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
    if($hashed == $request->signature_key){
        if($request->transaction_status == 'capture'){
            $order = Order::find($request->order_id);
            $order->update(['payment_mode' => $request-> payment_type]);
        }
    }
    return response()->json(['status' => 'success', 'message' => 'Payment mode updated successfully']);
}

}
