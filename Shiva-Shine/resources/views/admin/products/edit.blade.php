@extends('admin.layout')

@section('page-title', 'Edit Product')

@section('content')
<div class="min-h-screen flex items-center justify-center from-pink-50 via-white to-yellow-50 px-4 py-10">

    <div class="backdrop-blur-xl bg-white/30 border border-white/40 shadow-lg rounded-2xl p-8 w-full max-w-3xl">
        <!-- Title -->
        <h1 class="text-4xl font-extrabold text-pink-700 mb-6 text-center tracking-wide">
            Edit Product
        </h1>

        <form action="{{ route('admin.products.update', $product) }}"
              method="POST" enctype="multipart/form-data"
              class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Product Name -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Product Name</label>
                <input type="text" name="name" value="{{ $product->name }}"
                       class="w-full bg-white/60 border border-pink-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-pink-300 focus:outline-none shadow-sm">
            </div>

            <!-- Price -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Price (₹)</label>
                <input type="number" step="0.01" name="price" value="{{ $product->price }}"
                       class="w-full bg-white/60 border border-yellow-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-yellow-300 focus:outline-none shadow-sm">
            </div>

            <!-- Stock -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Stock</label>
                <input type="number" name="stock" value="{{ $product->stock }}"
                       class="w-full bg-white/60 border border-yellow-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-yellow-300 focus:outline-none shadow-sm">
            </div>

            <!-- Images -->
            <div>
                <label class="block text-lg font-semibold text-pink-700 mb-3">Product Images</label>
                <div class="grid grid-cols-2 gap-4">
                    @foreach(['image1','image2','image3','image4','image5'] as $img)
                        <div class="bg-white/50 p-4 rounded-xl shadow-sm border border-pink-100">
                            @if($product->$img)
                                <img src="{{ asset('storage/'.$product->$img) }}"
                                     class="w-20 h-20 object-cover rounded-lg border mb-2 mx-auto">
                            @else
                                <div class="w-20 h-20 flex items-center justify-center bg-pink-100 rounded-lg text-gray-400 mx-auto">
                                    N/A
                                </div>
                            @endif
                            <input type="file" name="{{ $img }}"
                                   class="w-full mt-2 text-sm bg-white/70 border border-pink-200 rounded-lg px-2 py-1 focus:ring focus:ring-pink-200">
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-between items-center pt-4">
                <a href="{{ route('admin.products') }}"
                   class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg shadow transition">
                    ← Back
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-gradient-to-r from-pink-500 to-yellow-400 hover:from-pink-600 hover:to-yellow-500 text-white font-semibold rounded-lg shadow-lg transition transform hover:scale-105">
                    Update Product
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
