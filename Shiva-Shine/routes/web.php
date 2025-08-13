<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\CustomerController;

Route::get('/', function () {
    return view('welcome');
});

// Wishlist
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/remove/{id}', function ($id) {
    return back()->with('message', 'Removed item #' . $id . ' from wishlist.');
})->name('wishlist.remove');
Route::post('/wishlist/add-to-cart/{id}', function ($id) {
    return back()->with('message', 'Added item #' . $id . ' to cart.');
})->name('wishlist.addToCart');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/remove/{id}', function ($id) {
    return redirect()->back()->with('success', 'Item removed.');
})->name('cart.remove');

// Account
Route::get('/account', [AccountController::class, 'index'])->name('account.index');

// Categories
Route::get('/all_category', [CategoryController::class, 'all'])->name('Category.all_category');
Route::get('/latest-collections', [CategoryController::class, 'latest_collections_category'])->name('Category.latest_collections_category');
Route::get('/mens-jewellery', [CategoryController::class, 'mensJewellery'])->name('category.mens.mens_jewellery');
Route::get('/womens-jewellery', [CategoryController::class, 'womensJewellery'])->name('category.Womens.womens_jewellery');

// Admin Redirect
Route::get('/admin', function () {
    return redirect()->route('admin.login');
});

// Admin Auth
Route::get('admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::get('admin/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
Route::get('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::get('admin/customers', [CustomerController::class, 'index'])->name('admin.customers');
Route::get('admin/products', [ProductController::class, 'index'])->name('admin.products');
Route::get('admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
Route::post('admin/products/store', [ProductController::class, 'store'])->name('admin.products.store');
Route::get('admin/products/edit/{id}', [ProductController::class, 'edit'])->name('admin.products.edit');
Route::post('admin/products/update/{id}', [ProductController::class, 'update'])->name('admin.products.update');
Route::post('admin/products/delete/{id}', function ($id) {
    return redirect()->route('admin.products')->with('success', 'Product deleted successfully.');
})->name('admin.products.destroy');
