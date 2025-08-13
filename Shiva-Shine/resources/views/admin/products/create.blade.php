@extends('admin.layout')

@section('page-title', 'Add Product')

@section('content')
<div class="min-h-screen flex items-center justify-center from-pink-50 via-white to-yellow-50 px-4 py-10">

    <div class="backdrop-blur-xl bg-white/30 border border-white/40 shadow-lg rounded-2xl p-8 w-full max-w-3xl">
        <!-- Title -->
        <h1 class="text-4xl font-extrabold text-pink-700 mb-6 text-center tracking-wide">
            Add New Product
        </h1>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Product Name -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Product Name</label>
                <input type="text" name="name" placeholder="Elegant Gold Ring"
                       class="w-full bg-white/60 border border-pink-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-pink-300 focus:outline-none shadow-sm">
            </div>

            <!-- Price -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Price (₹)</label>
                <input type="number" step="0.01" name="price" placeholder="1999.00"
                       class="w-full bg-white/60 border border-yellow-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-yellow-300 focus:outline-none shadow-sm">
            </div>

            <!-- Stock -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Stock</label>
                <input type="number" name="stock" placeholder="10"
                       class="w-full bg-white/60 border border-yellow-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-yellow-300 focus:outline-none shadow-sm">
            </div>

            <!-- Image Uploads -->
            <div>
                <label class="block text-lg font-semibold text-pink-700 mb-3">Product Images</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @for ($i = 1; $i <= 5; $i++)
                        <input type="file" name="image{{ $i }}"
                               class="w-full bg-white/60 border border-pink-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-yellow-200 focus:outline-none shadow-sm">
                    @endfor
                </div>
                <p class="text-sm text-gray-500 mt-2">Upload up to 5 images (JPG, PNG, max 2MB each).</p>
            </div>

            <!-- Buttons -->
            <div class="flex justify-between items-center pt-4">
                <a href="{{ route('admin.products') }}"
                   class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg shadow transition">
                    ← Back
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-gradient-to-r from-pink-500 to-yellow-400 hover:from-pink-600 hover:to-yellow-500 text-white font-semibold rounded-lg shadow-lg transition transform hover:scale-105">
                    Save Product
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
