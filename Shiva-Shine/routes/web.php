<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminProductController;

// Home
Route::get('/', function () {
    return view('welcome');
});

// User login/register
Route::get('login', [AuthController::class, 'loginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'registerForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Google login
Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

// Account
Route::get('/account', [AccountController::class, 'index'])->name('account.index');

// Routes that require authentication
Route::middleware(['auth'])->group(function () {

    // Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
    Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/remove/{id}', function ($id) {
        return redirect()->back()->with('success', 'Item removed.');
    })->name('cart.remove');

    // Profile page
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// Categories
Route::get('/products', [CategoryController::class, 'all'])->name('products.all');
Route::get('/all_category', [CategoryController::class, 'all'])->name('Category.all_category');
Route::get('/latest-collections', [CategoryController::class, 'latest_collections_category'])->name('Category.latest_collections_category');
Route::get('/mens-jewellery', [CategoryController::class, 'mensJewellery'])->name('category.mens.mens_jewellery');
Route::get('/products/{id}', [ProductController::class, 'userProductShow'])->name('products.show');
Route::get('/womens-jewellery', [CategoryController::class, 'womensJewellery'])->name('category.Womens.womens_jewellery');

// Admin Redirect
Route::get('/yuvraj@shivashine', function () {
    return redirect()->route('admin.login');
});

// Admin Auth
Route::get('admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::get('admin/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
Route::get('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin Customers
Route::get('admin/customers', [CustomerController::class, 'index'])->name('admin.customers');

// Admin Products
Route::get('admin/products', [AdminProductController::class, 'index'])->name('admin.products');
Route::get('admin/products/show/{id}', [AdminProductController::class, 'show'])->name('admin.products.show');
Route::get('admin/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
Route::post('admin/products/store', [AdminProductController::class, 'store'])->name('admin.products.store');
Route::get('admin/products/edit/{id}', [AdminProductController::class, 'edit'])->name('admin.products.edit');
Route::put('admin/products/update/{id}', [AdminProductController::class, 'update'])->name('admin.products.update');
Route::delete('admin/products/delete/{id}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');

// Admin Categories
Route::get('admin/categories', [ProductCategoryController::class, 'index'])->name('admin.categories');
Route::get('admin/categories/show/{category}', [ProductCategoryController::class, 'show'])->name('admin.categories.show');
Route::get('admin/categories/create', [ProductCategoryController::class, 'create'])->name('admin.categories.create');
Route::post('admin/categories/store', [ProductCategoryController::class, 'store'])->name('admin.categories.store');
Route::get('admin/categories/edit/{category}', [ProductCategoryController::class, 'edit'])->name('admin.categories.edit');
Route::put('admin/categories/update/{category}', [ProductCategoryController::class, 'update'])->name('admin.categories.update');
Route::delete('admin/categories/delete/{category}', [ProductCategoryController::class, 'destroy'])->name('admin.categories.destroy');
