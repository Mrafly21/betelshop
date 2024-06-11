<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\HelpController;
use App\Http\Controllers\Admin\RequestBecomeSellerController;
use App\Http\Controllers\Frontend\WishlistController;

Route::get('/',[App\Http\Controllers\Frontend\FrontendController::class, 'index'] );
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('login', [LoginController::class, 'login'])->name('login.submit');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('register', [RegisterController::class, 'register'])->name('register.submit');

Route::get('/',[App\Http\Controllers\Frontend\FrontendController::class, 'index'] );
Route::get('/collections', [App\Http\Controllers\Frontend\FrontendController::class, 'categories']);
Route::get('collections/{category_slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'products']);
Route::get('collections/{category_slug}/{product_slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'productView']);
Route::get('/newArrivals', [App\Http\Controllers\Frontend\FrontendController::class, 'newArrivals']);
Route::get('/featured-product', [App\Http\Controllers\Frontend\FrontendController::class, 'featuredProduct']);
Route::get('/search',  [App\Http\Controllers\Frontend\FrontendController::class, 'searchProduct']);

//Wishlist
Route::get('wishlist', [App\Http\Controllers\Frontend\WishlistController::class, 'index']);
Route::get('thank-you', [App\Http\Controllers\Frontend\FrontendController::class, 'thankyou']);

Route::get('orders', [App\Http\Controllers\Frontend\OrderController::class, 'index']);
Route::get('orders/{orderId}', [App\Http\Controllers\Frontend\OrderController::class, 'show']);

Route::get('become-seller', [App\Http\Controllers\Frontend\RequestBecomeSellerController::class, 'index']);
Route::post('submit-become-seller', [App\Http\Controllers\Frontend\RequestBecomeSellerController::class, 'submit'])->name('become-seller.submit');

Route::get('/help', [HelpController::class, 'index'])->name('help');
Route::post('/help/send', [HelpController::class, 'sendMessage'])->name('send.message');

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/remove/{itemId}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/increment/{itemId}', [CartController::class, 'incrementQuantity'])->name('cart.increment');
    Route::post('/cart/decrement/{itemId}', [CartController::class, 'decrementQuantity'])->name('cart.decrement');

    Route::post('/wishlist/add/{productId}', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
    Route::post('/wishlist/remove/{productId}', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');
    Route::get('checkout', [App\Http\Controllers\Frontend\CheckoutController::class, 'index']);
    Route::post('/checkout/process', [CheckoutController::class, 'placeOrder'])->name('checkout.process');
});



Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index']);

    //Category Routes
    Route::controller(App\Http\Controllers\admin\CategoryController::class)->group(function () {
        Route::get('category', 'index');
        Route::get('category/create', 'create');
        Route::post('category', 'store');
        Route::get('category/{category}/edit', 'edit');
        Route::put('category/{category}', 'update');
    });
    //Brand Routes
    // Route::get('brands', App\Http\Livewire\Admin\Brand\Index::class);

    //Product Controller
    Route::controller(App\Http\Controllers\admin\ProductController::class)->group(function () {
        Route::get('products', 'index');
        Route::get('products/create', 'create');
        Route::post('products', 'store');
        Route::get('products/{product}/edit', 'edit');
        Route::put('products/{product}', 'update');
        Route::get('products/{product_id}/delete', 'destroy');
        Route::get('product-image/{product_image_id}/delete', 'destroyImage');
        Route::post('product-color/{prod_color_id}', 'updateProductColorQty');
        Route::get('product-color/{prod_color_id}/delete', 'deleteProductColor');
    });

    //Order Controller
    Route::controller(App\Http\Controllers\admin\OrderController::class)->group(function () {
        Route::get('order', 'index');
        Route::get('/order/{orderId}', 'show');
        Route::put('/order/{orderId}', 'updateOrder');
        Route::get('/invoice/{orderId}', 'viewInvoice');
        Route::get('/invoice/{orderId}/generate', 'generateInvoice');
        Route::put('/order/{orderId}/edit', 'edit');
    });

    Route::controller(App\Http\Controllers\admin\UserController::class)->group(function () {
        Route::get('/users', 'index');
        Route::get('/users/create', 'create');
        Route::post('users', 'store');
        Route::get('users/{user_id}/edit', 'edit');
        Route::put('users/{user_id}', 'update');
        Route::get('users/{user_id}/delete', 'destroy');
        Route::get('users/change-password', 'passwordCreate');
        Route::post('users/change-password', 'changePassword');
    });

    Route::get('/message', [App\Http\Controllers\Admin\MessageController::class, 'index'])->name('admin.messages.index');
    Route::get('/message/{id}', [App\Http\Controllers\Admin\MessageController::class, 'show'])->name('admin.messages.show');

    Route::get('become-seller', [RequestBecomeSellerController::class, 'index']);
    Route::post('become-seller/accept/{id}', [RequestBecomeSellerController::class, 'accept'])->name('admin.request-become-seller.accept');
    Route::post('become-seller/reject/{id}', [RequestBecomeSellerController::class, 'reject'])->name('admin.request-become-seller.reject');
});