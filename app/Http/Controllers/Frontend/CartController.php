<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(){
        $cartlist = Cart::where('user_id', auth()->id())->get(); // Adjust based on your database structure
        
        // Calculate total price here or in the view
        $totalPrice = 0;
        foreach ($cartlist as $item) {
            $totalPrice += $item->product->selling_price * $item->quantity;
        }

        return view('frontend.cart.index', compact('cartlist', 'totalPrice'));
    }

    public function addToCart($productId, Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to continue.');
        }

        $product = Product::where('id', $productId)->where('status', 0)->first();

        if (!$product) {
            return back()->with('error', 'Product does not exist.');
        }

        $cart = Cart::where('user_id', Auth::id())
                    ->where('product_id', $productId)
                    ->first();

        if ($cart) {
            return back()->with('error', 'Product already added to cart.');
        }

        Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $productId,
            'quantity' => 1 // Modify as needed or take from $request
        ]);

        return back()->with('success', 'Product added to cart successfully.');
    }

    public $category, $product, $prodColorSelectedQuantity, $quantityCount = 1, $productColorId;

    public function incrementQuantity($itemId)
    {
        $cartItem = Cart::find($itemId);
        if ($cartItem && $cartItem->quantity < 10) {
            $cartItem->increment('quantity');
        }
        return redirect()->route('cart.index')->with('success', 'Quantity increased');
    }
    
    public function decrementQuantity($itemId)
    {
        $cartItem = Cart::find($itemId);
        if ($cartItem && $cartItem->quantity > 1) {  // Prevent quantity from going below 1
            $cartItem->decrement('quantity');
        }
        return redirect()->route('cart.index')->with('success', 'Quantity decreased');
    }
    
    public function removeFromCart($itemId)
    {
        $cartItem = Cart::find($itemId);
        if ($cartItem) {
            $cartItem->delete();
        }
        return redirect()->route('cart.index')->with('success', 'Item removed from cart');
    }
    
}
