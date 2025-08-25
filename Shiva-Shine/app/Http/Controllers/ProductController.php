<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    // Show product list
    public function index()
    {
      $products = Product::latest()->paginate(6); // 6 products per page
        return view('admin.products.products', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    // Show create product form
    public function create()
    {
        return view('admin.products.create');
    }

    // Store new product
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image1' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image2' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image3' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image4' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image5' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle images
        foreach (['image1', 'image2', 'image3', 'image4', 'image5'] as $img) {
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
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image1' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image2' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image3' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image4' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image5' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $product = Product::findOrFail($id);

        foreach (['image1', 'image2', 'image3', 'image4', 'image5'] as $img) {
            if ($request->hasFile($img)) {
                // Delete old image if exists
                if ($product->$img && Storage::disk('public')->exists($product->$img)) {
                    Storage::disk('public')->delete($product->$img);
                }

                // Store new image
                $validated[$img] = $request->file($img)->store('products', 'public');
            }
        }

        $product->update($validated);

        return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
    }



    // Delete product
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect()->route('admin.products')->with('success', 'Product deleted successfully!');
    }
}
