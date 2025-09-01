<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CategoryController extends Controller
{
    // All products (with optional category filter)
    public function all(Request $request)
    {
        $query = Product::query();

        if ($request->has('category') && $request->category !== 'all') {
            $query->where('category_id', $request->category);
        }

        $products = $query->latest()->get();
        $categories = Category::orderBy('name')->get();

        return view('Category.all_category', compact('products', 'categories'));
    }

    // Men's Jewellery
    public function mensJewellery()
    {
        // Fetch categories for men (Male or Both) - case insensitive
        $categoryIds = Category::whereRaw("LOWER(gender) IN ('male', 'both')")
            ->pluck('id');

        // Fetch products that belong to these categories
        $products = Product::whereIn('category_id', $categoryIds)
            ->latest()
            ->get();

        // Fetch all categories for filter dropdown
        $categories = Category::orderBy('name')->get();

        return view('Category.Mens.mens_jewellery', compact('products', 'categories'));
    }

    // Women's Jewellery
    public function womensJewellery()
    {
        // Fetch categories for women (Female or Both) - case insensitive
        $categoryIds = Category::whereRaw("LOWER(gender) IN ('female', 'both')")
            ->pluck('id');

        // Fetch products that belong to these categories
        $products = Product::whereIn('category_id', $categoryIds)
            ->latest()
            ->get();

        // Fetch all categories for filter dropdown
        $categories = Category::orderBy('name')->get();

        return view('Category.Womens.womens_jewellery', compact('products', 'categories'));
    }

    // Latest Collections
    public function latest_collections_category()
    {
        $products = Product::orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $categories = Category::orderBy('name')->get();

        return view('Category.latest_collections_category', compact('products', 'categories'));
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
