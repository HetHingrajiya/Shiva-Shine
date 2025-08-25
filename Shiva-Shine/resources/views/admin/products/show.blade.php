@extends('admin.layout')

@section('page-title', 'View Product')

@section('content')
    <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-100 max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold text-[#633d2e] mb-8">📦 Product Details</h1>

        <!-- ✅ Product Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
            <div class="p-4 bg-gray-50 rounded-xl border border-gray-200 shadow-sm">
                <p class="text-sm text-gray-500">Name</p>
                <p class="text-xl font-semibold text-gray-800">{{ $product->name }}</p>
            </div>
            <div class="p-4 bg-gray-50 rounded-xl border border-gray-200 shadow-sm">
                <p class="text-sm text-gray-500">Price</p>
                <p class="text-xl font-semibold text-green-600">₹{{ number_format($product->price, 2) }}</p>
            </div>
            <div class="p-4 bg-gray-50 rounded-xl border border-gray-200 shadow-sm">
                <p class="text-sm text-gray-500">Stock</p>
                <p class="text-xl font-semibold">{{ $product->stock }}</p>
            </div>
            <div class="p-4 bg-gray-50 rounded-xl border border-gray-200 shadow-sm">
                <p class="text-sm text-gray-500">Category</p>
                <p class="text-xl font-semibold">{{ $product->category->name ?? 'N/A' }}</p>
            </div>
        </div>

        <!-- ✅ Product Images -->
        <div class="mt-8">
            <p class="text-sm text-gray-500 mb-4">Product Images</p>

            @php
                // Collect all possible image fields (up to 5 images)
                $images = [
                    $product->image1,
                    $product->image2 ?? null,
                    $product->image3 ?? null,
                    $product->image4 ?? null,
                    $product->image5 ?? null,
                ];
                $images = array_filter($images); // remove null values
            @endphp

            @if (count($images) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                    @foreach ($images as $img)
                        <div class="relative group overflow-hidden rounded-xl shadow-md border border-gray-200">
                            <img src="{{ asset('storage/' . $img) }}"
                                 alt="Product Image"
                                 class="w-full h-56 object-cover transform group-hover:scale-110 transition duration-500 ease-in-out">
                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100
                                        flex items-center justify-center transition duration-300">
                                <a href="{{ asset('storage/' . $img) }}" target="_blank"
                                   class="px-3 py-1 bg-white text-gray-700 rounded-lg shadow font-medium hover:bg-gray-100">
                                    🔍 View
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-400 italic">No Images Available</p>
            @endif
        </div>

        <!-- ✅ Buttons -->
        <div class="mt-10 flex gap-4">
            <a href="{{ route('admin.products') }}"
               class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg shadow transition">⬅ Back</a>
            <a href="{{ route('admin.products.edit', $product) }}"
               class="px-5 py-2 bg-yellow-400 hover:bg-yellow-500 text-white rounded-lg shadow transition">✏ Edit</a>
        </div>
    </div>
@endsection
