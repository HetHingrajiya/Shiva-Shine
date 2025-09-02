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

    return view('Category.Mens.mens_jewellery', compact('products', 'categories'));
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

    return view('Category.Womens.womens_jewellery', compact('products', 'categories'));
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
            ->latest()
            ->get();
    } else {
        // All products under selected gender's categories or all categories if 'all'
        $categoryIds = $selectedGender != 'all'
            ? $categories->pluck('id')
            : Category::pluck('id');

        $products = Product::whereIn('category_id', $categoryIds)
            ->latest()
            ->get();
    }

    return view('Category.latest_collections_category', compact('products', 'categories', 'genders', 'selectedGender'));
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
