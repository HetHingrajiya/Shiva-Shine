<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/all_category', [CategoryController::class, 'all'])->name('Category.all_category');
Route::get('/mens-jewellery', [CategoryController::class, 'mensJewellery'])->name('category.mens.mens_jewellery');
