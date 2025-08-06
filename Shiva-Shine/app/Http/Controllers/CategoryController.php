<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CategoryController extends Controller
{
    public function all()
    {
        // Logic to retrieve all categories from the database
        // For now, we will return a view
        return view('Category.all_category');
    }
    public function mensJewellery()
    {
        return view('Category.Mens.mens_jewellery');
    }
    public function womensJewellery()
    {
        return view('Category.Womens.womens_jewellery');
    }
    public function latest_collections_category()
    {
        return view('Category.latest_collections_category');
    }
}
