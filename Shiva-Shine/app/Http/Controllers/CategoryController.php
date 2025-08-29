<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CategoryController extends Controller
{
    // All products
    public function all(Request $request)
    {
        $query = Product::query();

        if ($request->has('category') && $request->category !== 'all') {
            $query->where('category_id', $request->category);
        }

        $products = $query->latest()->get();
        $categories = Category::all();

        return view('Category.all_category', compact('products', 'categories'));
    }


    // Men's Jewellery
    public function mensJewellery()
    {
        $categories = Category::whereIn('gender', ['Male', 'Both'])->pluck('id');

        $products = Product::whereIn('category_id', $categories)
            ->latest()
            ->get();

        return view('Category.Mens.mens_jewellery', compact('products'));
    }

    // Women's Jewellery
    public function womensJewellery()
    {
        $categories = Category::whereIn('gender', ['Female', 'Both'])->pluck('id');

        $products = Product::whereIn('category_id', $categories)
            ->latest()
            ->get();

        return view('Category.Womens.womens_jewellery', compact('products'));
    }


    // Latest Collections
    public function latest_collections_category()
    {
        $products = Product::orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('Category.latest_collections_category', compact('products'));
    }

    // Filter products by category
    public function filter(Request $request)
    {
        $query = Product::query();

        if ($request->has('category') && $request->category != 'all') {
            $query->where('category_id', $request->category);
        }

        $products = $query->latest()->get();
        $categories = Category::all();

        return view('Category.all_category', compact('products', 'categories'));
    }
}
