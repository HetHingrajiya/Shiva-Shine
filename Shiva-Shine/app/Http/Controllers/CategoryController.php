<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

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
        $products = Product::where('category', 'mens')
            ->latest()
            ->get();
        return view('Category.Mens.mens_jewellery', compact('products'));
    }

    // Women's Jewellery
    public function womensJewellery()
    {
        $products = Product::where('category', 'womens')
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
