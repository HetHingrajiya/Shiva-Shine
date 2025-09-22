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
        // Fetch categories
        $categories = Category::orderBy('name')->get();

        // Fetch products for homepage sliders or sections
        $latestProducts = Product::latest()->take(10)->get(); // Latest products
        $mensProducts = Product::whereHas('category', function($q) {
            $q->whereRaw("LOWER(gender) = 'male'");
        })->take(10)->get();

        $womensProducts = Product::whereHas('category', function($q) {
            $q->whereRaw("LOWER(gender) = 'female'");
        })->take(10)->get();

        // Wishlist for logged-in user
        $wishlist = [];
        if (Auth::check()) {
            $wishlist = Wishlist::where('user_id', Auth::id())
                        ->pluck('product_id')
                        ->toArray();
        }

        return view('welcome', compact(
            'categories',
            'latestProducts',
            'mensProducts',
            'womensProducts',
            'wishlist'
        ));
    }
}
