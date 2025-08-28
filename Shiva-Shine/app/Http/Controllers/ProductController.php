<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductController extends Controller
{
    // Show product list
   public function index(Request $request)
    {
    // Start query
        $query = Product::with('category'); // eager load category

        // If search term exists
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('price', 'LIKE', "%{$search}%")
                ->orWhereHas('category', function($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%");
                });
        }

        // Get paginated results
        $products = $query->orderBy('created_at', 'desc')->paginate(12);

        // Keep search term in pagination links
        $products->appends($request->all());

        return view('admin.products.products', compact('products'));
    }


    // Show single product details
    public function show($id)
    {
        // Fetch product with category name and gender
        $product = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select(
                'products.*',
                'categories.name as category_name',
                'categories.gender as category_gender'
            )
            ->where('products.id', $id)
            ->first();

        if (!$product) {
            abort(404, 'Product not found');
        }

        // Convert string timestamps to Carbon instances
        $product->created_at = Carbon::parse($product->created_at);
        $product->updated_at = Carbon::parse($product->updated_at);



        // Pass product to the view
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
        // Fetch product along with its category info
        $product = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select(
                'products.*',
                'categories.name as category_name',
                'categories.gender as category_gender'
            )
            ->where('products.id', $id)
            ->first();

        // Convert string timestamps to Carbon objects for Blade formatting
        if ($product) {
            $product->created_at = \Carbon\Carbon::parse($product->created_at);
            $product->updated_at = \Carbon\Carbon::parse($product->updated_at);
        }

        // Fetch all categories for dropdown
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
