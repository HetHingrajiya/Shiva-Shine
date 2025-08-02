<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/all_category', [CategoryController::class, 'all'])->name('Category.all_category');
