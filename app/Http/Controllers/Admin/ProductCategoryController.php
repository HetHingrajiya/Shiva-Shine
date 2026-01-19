<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index(Request $request)
    {
        $query = Category::query();

        // Filter by gender
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // Filter by search term (category name)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        // Paginate results (6 per page)
        $categories = $query->latest()->paginate(6);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        // Validate input with unique name per gender
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories')->where(function ($query) use ($request) {
                    return $query->where('gender', $request->gender);
                }),
            ],
            'gender' => 'required|in:Male,Female,Both',
        ]);

        // Create category
        Category::create($request->only('name', 'gender'));

        return redirect()->route('admin.categories')
            ->with('success', "Category '{$request->name}' added successfully!");
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, Category $category)
    {
        // Validate input with unique per gender, ignoring current category ID
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories')->ignore($category->id)->where(function ($query) use ($request) {
                    return $query->where('gender', $request->gender);
                }),
            ],
            'gender' => 'required|in:Male,Female,Both',
        ]);

        $category->update($request->only('name', 'gender'));

        return redirect()->route('admin.categories')
            ->with('success', "Category '{$request->name}' updated successfully!");
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories')
            ->with('success', "Category '{$category->name}' deleted successfully!");
    }
}
