<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\HomeController;


// Home
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-shivashine', function () {
    return view('about-shivashine');
})->name('more');

// Login & Register (handled via modal in account page)
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Google Login
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

// Forgot Password
Route::get('/forgot-password', [PasswordResetController::class, 'showLinkRequestForm'])
    ->name('password.request');

Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLinkEmail'])
    ->name('password.email');

// Reset Password
Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])
    ->name('password.reset');

Route::post('/reset-password', [PasswordResetController::class, 'reset'])
    ->name('password.update');

// Account Dashboard
Route::get('/account', [AccountController::class, 'index'])->name('account.index');

// Routes that require authentication
Route::middleware(['auth'])->group(function () {

    // Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
    Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');
    Route::get('/checkout/success/{id}', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::post('/checkout/send-otp', [OtpController::class, 'sendOtp'])->name('checkout.sendOtp');
    Route::post('/checkout/verify-otp', [OtpController::class, 'verifyOtp'])->name('checkout.verifyOtp');

    //order page
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{encryptedId}/{encryptedOrderCode}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::post('/orders/{id}/return', [OrderController::class, 'return'])->name('orders.return');


    // Profile page
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    // Contact Us Page
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');

    // FAQ / Help Page
    Route::get('/faq', [FAQController::class, 'index'])->name('faq.index');

    // Support Chat Page
    Route::get('/support-chat', [SupportController::class, 'index'])->name('support.chat');
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

Route::get('admin/analytics', [AnalyticsController::class, 'index'])->name('admin.analytics');

// Admin Customers
Route::get('admin/customers', [CustomerController::class, 'index'])->name('admin.customers');
Route::put('admin/customers/{id}', [CustomerController::class, 'update'])->name('admin.customers.update');
Route::delete('admin/customers/{id}', [CustomerController::class, 'destroy'])->name('admin.customers.destroy');

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


Route::prefix('admin/orders')->name('admin.orders.')->group(function () {
    Route::get('/', [AdminOrderController::class, 'index'])->name('index'); // admin.orders.index
    Route::get('/{id}', [AdminOrderController::class, 'show'])->name('show'); // admin.orders.show
    Route::delete('/{id}', [AdminOrderController::class, 'destroy'])->name('destroy'); // admin.orders.destroy
    Route::patch('/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('updateStatus'); // admin.orders.updateStatus
    Route::get('/status/{status}', [AdminOrderController::class, 'filter'])->name('filter'); // admin.orders.filter




});




// Settings main overview
Route::get('admin/settings', [SettingsController::class, 'index'])->name('admin.settings');
// Profile
Route::get('admin/settings/profile', [SettingsController::class, 'profile'])->name('admin.settings.profile');
Route::post('admin/settings/profile', [SettingsController::class, 'updateProfile'])->name('admin.settings.profile.update');
// Security (Change Password)
Route::get('admin/settings/security', [SettingsController::class, 'security'])->name('admin.settings.security');
Route::post('admin/settings/security', [SettingsController::class, 'updatePassword'])->name('admin.settings.security.update');
// Notifications
Route::get('admin/settings/notifications', [SettingsController::class, 'notifications'])->name('admin.settings.notifications');
// Preferences
Route::get('admin/settings/preferences', [SettingsController::class, 'preferences'])->name('admin.settings.preferences');
