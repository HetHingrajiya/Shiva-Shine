<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Show product list
    public function index()
    {
        // Eager load category to avoid N+1 problem
        $products = Product::with('category')->latest()->paginate(6);
        return view('admin.products.products', compact('products'));
    }

    // Show single product details
 public function show($id)
{
    // Load the product with its category
    $product = Product::with('category')->findOrFail($id);

    return view('admin.products.show', compact('product'));
}


    // Show create product form
    public function create()
    {
        // Fetch categories for dropdown
        $categories = Category::orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    // Store new product
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image1'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image2'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image3'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image4'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image5'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle images
        foreach (['image1','image2','image3','image4','image5'] as $img) {
            if ($request->hasFile($img)) {
                $validated[$img] = $request->file($img)->store('products', 'public');
            }
        }

        Product::create($validated);

        return redirect()->route('admin.products')->with('success', 'Product added successfully!');
    }

    // Show edit product form
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Update product
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image1'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image2'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image3'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image4'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image5'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $product = Product::findOrFail($id);

        foreach (['image1','image2','image3','image4','image5'] as $img) {
            if ($request->hasFile($img)) {
                if ($product->$img && Storage::disk('public')->exists($product->$img)) {
                    Storage::disk('public')->delete($product->$img);
                }
                $validated[$img] = $request->file($img)->store('products', 'public');
            }
        }

        $product->update($validated);

        return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
    }

    // Delete product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        foreach (['image1','image2','image3','image4','image5'] as $img) {
            if ($product->$img && Storage::disk('public')->exists($product->$img)) {
                Storage::disk('public')->delete($product->$img);
            }
        }

        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Product deleted successfully!');
    }
}
