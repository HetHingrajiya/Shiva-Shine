<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CategoryController extends Controller
{
    // All products
    public function all()
    {
        $products = Product::latest()->get();
        return view('Category.all_category', compact('products'));
    }

    // Men's Jewellery
    public function mensJewellery()
    {
        $category = Category::where('name', 'mens')->first();

        $products = Product::where('category_id', $category->id)
            ->latest()
            ->get();

        return view('Category.Mens.mens_jewellery', compact('products'));
    }

    // Women's Jewellery
    public function womensJewellery()
    {
        $category = Category::where('name', 'womens')->first();

        $products = Product::where('category_id', $category->id)
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
}
