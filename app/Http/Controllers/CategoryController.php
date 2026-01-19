<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    // All products (with optional category filter)
    public function all(Request $request)
    {
        $query = Product::query();

        // Apply gender filter if provided and not "all"
        if ($request->has('gender') && $request->gender !== 'all') {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('gender', $request->gender);
            });
        }

        // Apply category filter if provided and not "all"
        if ($request->has('category_id') && $request->category_id !== 'all') {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->latest()->get();
        $categories = Category::orderBy('name')->get();

        // Fetch user's wishlist if logged in
        $wishlist = [];
        if (Auth::check()) {
            $wishlist = Wishlist::where('user_id', Auth::id())
                        ->pluck('product_id')
                        ->toArray();
        }
        return view('Category.all_category', compact('products', 'categories', 'wishlist'));
    }

    // Men's Jewellery
    public function mensJewellery(Request $request)
{
    // ✅ Fetch only Male categories (case-insensitive)
    $categories = Category::whereRaw("LOWER(gender) = 'male'")
        ->orderBy('name')
        ->get();

    // ✅ If category is selected, filter products
    if ($request->has('category_id') && $request->category_id != 'all') {
        $products = Product::where('category_id', $request->category_id)
            ->latest()
            ->get();
    } else {
        // Show all products under Male categories
        $categoryIds = $categories->pluck('id');
        $products = Product::whereIn('category_id', $categoryIds)
            ->latest()
            ->get();
    }

    // ✅ Get wishlist product IDs for the logged-in user
    $wishlist = [];
    if (Auth::check()) {
        $wishlist = Wishlist::where('user_id', Auth::id())
                    ->pluck('product_id')
                    ->toArray();
    }

    // ✅ Pass products, categories, and wishlist to view
    return view('Category.Mens.mens_jewellery', compact('products', 'categories', 'wishlist'));
}



   // Women's Jewellery
   public function womensJewellery(Request $request)
   {
       // ✅ Fetch only Female categories (case-insensitive)
       $categories = Category::whereRaw("LOWER(gender) = 'female'")
           ->orderBy('name')
           ->get();

       // ✅ If category is selected, filter products
       if ($request->has('category_id') && $request->category_id != 'all') {
           $products = Product::where('category_id', $request->category_id)
               ->latest()
               ->get();
       } else {
           // Show all products under Female categories
           $categoryIds = $categories->pluck('id');
           $products = Product::whereIn('category_id', $categoryIds)
               ->latest()
               ->get();
       }

       // ✅ Fetch wishlist for logged-in user
       $wishlist = [];
       if (Auth::check()) {
           $wishlist = Wishlist::where('user_id', Auth::id())
                       ->pluck('product_id')
                       ->toArray();
       }

       return view('Category.Womens.womens_jewellery', compact('products', 'categories', 'wishlist'));
   }



   public function latest_collections_category(Request $request)
{
    // ✅ Get selected gender or default to 'all'
    $selectedGender = $request->gender ?? 'all';

    // ✅ Fetch unique genders for the first dropdown
    $genders = Category::selectRaw("LOWER(gender) as gender")
        ->distinct()
        ->pluck('gender');

    // ✅ Fetch categories based on selected gender
    if ($selectedGender != 'all') {
        $categories = Category::whereRaw("LOWER(gender) = ?", [$selectedGender])
            ->orderBy('name')
            ->get();
    } else {
        $categories = Category::orderBy('name')->get();
    }

    // ✅ Fetch products based on category filter
    if ($request->has('category_id') && $request->category_id != 'all') {
        $products = Product::where('category_id', $request->category_id)
            ->orderBy('id', 'asc') // Fetch by least ID first
            ->get();
    } else {
        // All products under selected gender's categories or all categories if 'all'
        $categoryIds = $selectedGender != 'all'
            ? $categories->pluck('id')
            : Category::pluck('id');

        $products = Product::whereIn('category_id', $categoryIds)
            ->orderBy('id', 'asc') // Fetch by least ID first
            ->get();
    }

    // ✅ Get wishlist items for logged-in user
    $wishlist = [];
    if (Auth::check()) {
        $wishlist = Wishlist::where('user_id', Auth::id())
                    ->pluck('product_id')
                    ->toArray();
    }

    return view('Category.latest_collections_category', compact(
        'products',
        'categories',
        'genders',
        'selectedGender',
        'wishlist' // Pass wishlist to the view
    ));
}



    // Filter products by category (used by your select control)
    public function filter(Request $request)
    {
        $query = Product::query();

        if ($request->has('category') && $request->category != 'all') {
            $query->where('category_id', $request->category);
        }

        $products = $query->latest()->get();
        $categories = Category::orderBy('name')->get();

        return view('Category.all_category', compact('products', 'categories'));
    }
}
