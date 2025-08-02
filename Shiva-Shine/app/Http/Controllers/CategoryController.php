<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function all()
    {
        // Logic to retrieve all categories from the database
        // For now, we will return a view
        return view('Category.all_category');
    }
}
