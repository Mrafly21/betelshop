<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
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
            'payment_mode' => 'required'
        ]);

        $order = Order::create([
            'user_id' => Auth::id(),
            'tracking_no' => 'ORD' . Str::random(10),
            'fullname' => $validated['fullname'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'pincode' => $validated['pincode'],
            'address' => $validated['address'],
            'status_message' => 'in progress',
            'payment_mode' => $validated['payment_mode'],
            'payment_id' => $validated['payment_id'] ?? null
        ]);

        $carts = Cart::where('user_id', Auth::id())->get();
        $totalAmount = 0;

        foreach ($carts as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product_color_id' => $cartItem->product_color_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->selling_price,
            ]);

            $totalAmount += $cartItem->product->selling_price * $cartItem->quantity;
            // Adjust inventory logic here as per your model relationships
        }

        Cart::where('user_id', Auth::id())->delete();
        return redirect('thank-you')->with('message', 'Order Placed Successfully');
    }
}
