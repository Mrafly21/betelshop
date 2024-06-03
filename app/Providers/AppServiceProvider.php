<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
{
    View::composer('*', function ($view) {
        if (Auth::check()) {
            $cartCount = Cart::where('user_id', Auth::id())->count();
            $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
        } else {
            $cartCount = 0;
            $wishlistCount = 0;
        }

        $view->with('cartCount', $cartCount)
             ->with('wishlistCount', $wishlistCount);
    });
}
}
