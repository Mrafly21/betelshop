<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Sliders;
use App\Models\Category;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public $quantityCount = 1;
    public function index()
    {
        $sliders = Sliders::where('status', '0')->get();
        $trendingProducts = Product::where('trending', '1')->latest()->take(15)->get();
        $newArrivalProducts = Product::latest()->take(14)->get();
        $featuredProduct = Product::where('featured', '1')->latest()->take(14)->get();
        return view('frontend.index', compact('sliders', 'trendingProducts', 'newArrivalProducts', 'featuredProduct'));
    }

    public function categories()
    {   
        $categories = Category::where('status', '0')->get();
        return view('frontend.collections.category.index', compact('categories'));
    }

    public function products($category_slug){
        $category = Category::where('slug', $category_slug)->first();
        if($category){
            $products = $category->products()->where('status', '0')->get();
            return view('frontend.collections.products.index', compact('category', 'products'));
        } else {
            return redirect()->back()->with('message', 'Category not found.');
        }
    }
    

    public function productView(string $category_slug, string $product_slug){
        $category = Category::where('slug', $category_slug)->first();
        if($category){
            $product = $category->products()->where('slug', $product_slug)->where('status', '0')->first();
            if($product){
                return view('frontend.collections.products.view', compact('product' ,'category'));
            }else{
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }
    }

    public function thankyou(){
        return view('frontend.thank-you');
    }

    public function newArrivals(){
        $newArrivalProducts = Product::latest()->take(16)->get();
        return view('frontend.pages.new-arrival', compact('newArrivalProducts'));
    }

    public function featuredProduct(){
        $featuredProduct = Product::where('featured', '1')->latest()->get();
        return view('frontend.pages.feature-product', compact('featuredProduct'));
    }

    public function searchProduct(Request $request){
        if($request->search){
            $searchProduct = Product::where('name', 'LIKE', '%'.$request->search.'%')->latest()->paginate(15);
            return view('frontend.pages.search', compact('searchProduct'));
        }
        else{
            return redirect()->back()->with('message', 'Empty Search');
        }
    }

    public function incrementQuantity()
    {
        if ($this->quantityCount < 10) {
            $this->quantityCount++;
        } else {
            session()->flash('warning', 'Max quantity item is 10');
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantityCount > 0) {
            $this->quantityCount--;
        }
    }
}
