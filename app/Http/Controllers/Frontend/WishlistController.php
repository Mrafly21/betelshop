<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Wishlist::where('user_id', auth()->id())->get();

        return view('frontend.wishlist.index', compact('wishlist'));
    }

    public function addToWishlist($productId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to continue.');
        }

        $product = Product::find($productId);
        if (!$product) {
            return back()->with('error', 'Product not found.');
        }

        if (Wishlist::where('user_id', Auth::id())->where('product_id', $productId)->exists()) {
            return back()->with('error', 'Already added to Wishlist.');
        }

        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $productId
        ]);

        return back()->with('success', 'Added to Wishlist successfully.');
    }

    public function removeFromWishlist($productId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to continue.');
        }

        $wishlistItem = Wishlist::where('user_id', Auth::id())->where('product_id', $productId)->first();
        if ($wishlistItem) {
            $wishlistItem->delete();
            return back()->with('success', 'Removed from Wishlist successfully.');
        }

        return back()->with('error', 'Item not found in Wishlist.');
    }
}
