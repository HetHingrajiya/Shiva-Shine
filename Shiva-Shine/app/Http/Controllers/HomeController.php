<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {

        // Categories
        $categories = Category::orderBy('name')->get();

        // Latest Products
        $latestProducts = Product::latest()->take(10)->get();

        // Men's Products
        $mensProducts = Product::whereHas('category', function ($q) {
            $q->whereRaw("LOWER(gender) = 'male'");
        })->take(10)->get();

        // Women's Products
        $womensProducts = Product::whereHas('category', function ($q) {
            $q->whereRaw("LOWER(gender) = 'female'");
        })->take(10)->get();

        // **All products** (avoid undefined $products in blade)
        $products = Product::latest()->take(10)->get();

        // Wishlist
        $wishlist = [];
        if (Auth::check()) {
            $wishlist = Wishlist::where('user_id', Auth::id())
                ->pluck('product_id')
                ->toArray();
        }

        // Pass data to view (note 'products' included)
        return view('welcome', compact(
            'categories',
            'latestProducts',
            'mensProducts',
            'womensProducts',
            'products',
            'wishlist'
        ));
    }
}
