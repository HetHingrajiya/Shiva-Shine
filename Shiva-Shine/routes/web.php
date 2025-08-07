<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AccountController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/remove/{id}', function ($id) {
    return back()->with('message', 'Removed item #' . $id . ' from wishlist.');
})->name('wishlist.remove');
Route::post('/wishlist/add-to-cart/{id}', function ($id) {
    return back()->with('message', 'Added item #' . $id . ' to cart.');
})->name('wishlist.addToCart');



Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/remove/{id}', function ($id) {
    // For now, just redirect back
    return redirect()->back()->with('success', 'Item removed.');
})->name('cart.remove');


Route::get('/account', [AccountController::class, 'index'])->name('account.index');

Route::get('/all_category', [CategoryController::class, 'all'])->name('Category.all_category');
Route::get('/latest-collections', [CategoryController::class, 'latest_collections_category'])->name('Category.latest_collections_category');
Route::get('/mens-jewellery', [CategoryController::class, 'mensJewellery'])->name('category.mens.mens_jewellery');
Route::get('/womens-jewellery', [CategoryController::class, 'womensJewellery'])->name('category.Womens.womens_jewellery');
