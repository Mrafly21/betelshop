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
    
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        if ($carts->isEmpty()) {
            return redirect('collections')->with('error', 'No items in cart to checkout.');
        }
    
        // Group cart items by seller_id
        $cartGroups = $carts->groupBy(function ($item) {
            return $item->product->user_id;
        });
    
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
                'payment_mode' => $validated['payment_mode'],
                'payment_id' => $validated['payment_id'] ?? null
            ]);
    
            foreach ($items as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'product_color_id' => $cartItem->product_color_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->selling_price,
                ]);
            }
        }
    
        Cart::where('user_id', Auth::id())->delete();
        return redirect('thank-you')->with('message', 'Orders Placed Successfully for Multiple Sellers');
    }
    
    
}
