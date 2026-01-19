@extends('admin.layout')

@section('page-title', 'Products')

@section('content')

<!-- Header -->
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">📦 Manage Products</h1>
    <a href="{{ route('admin.products.create') }}"
       class="px-6 py-2 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold rounded-lg shadow transition duration-300">
        + Add Product
    </a>
</div>

<!-- Success Message -->
@if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow mb-6">
        {{ session('success') }}
    </div>
@endif

<!-- Search Bar -->
<form method="GET" action="{{ route('admin.products') }}" class="mb-6">
    <div class="flex max-w-md mx-auto bg-white shadow rounded-lg border overflow-hidden">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="🔎 Search products..."
               class="w-full px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-300">
        <button type="submit" class="px-5 py-2 bg-gray-800 text-white hover:bg-gray-900 transition">
            Search
        </button>
    </div>
</form>

<!-- Products Row (4 per row) -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
    @forelse($products as $product)
        <div class="bg-white border border-gray-200 rounded-xl shadow hover:shadow-lg transition flex flex-col overflow-hidden">

            <!-- Product Image -->
            <div class="w-full h-48 bg-gray-100 overflow-hidden rounded-t-xl relative">
                @if($product->image1)
                    <img src="{{ asset('storage/' . $product->image1) }}" alt="Product Image"
                         class="w-full h-full object-cover object-center transition-transform duration-300 hover:scale-105">
                @else
                    <div class="flex items-center justify-center h-full text-gray-400 italic">No Image</div>
                @endif

                <!-- Action Buttons -->
                <div class="absolute top-2 right-2 flex gap-1 opacity-0 hover:opacity-100 transition">
                    <a href="{{ route('admin.products.edit', $product->id) }}"
                       class="px-2 py-1 text-xs bg-yellow-500 hover:bg-yellow-600 text-white rounded shadow font-medium transition">
                        ✏
                    </a>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-2 py-1 text-xs bg-red-500 hover:bg-red-600 text-white rounded shadow font-medium transition">
                            🗑
                        </button>
                    </form>
                </div>
            </div>

            <!-- Product Info -->
            <div class="p-4 flex flex-col justify-between flex-1">
                <div>
                    <h2 class="text-md font-semibold text-gray-900 truncate">{{ $product->name }}</h2>
                    <p class="text-lg font-bold text-green-600 mt-1">₹{{ number_format($product->price, 2) }}</p>

                    <!-- Stock Badge -->
                    <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full mt-2
                        {{ $product->stock > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                        {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                    </span>

                    <!-- Category & Gender -->
                    <div class="flex flex-wrap gap-1 mt-2">
                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full">📂 {{ $product->category->name ?? 'N/A' }}</span>
                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full">👤 {{ $product->category->gender ?? 'N/A' }}</span>
                    </div>
                </div>

                <!-- View Button -->
                <a href="{{ route('admin.products.show', $product->id) }}"
                   class="mt-4 w-full text-center px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md font-semibold shadow transition">
                   🔍 View
                </a>
            </div>
        </div>
    @empty
        <div class="col-span-full text-center text-gray-500 italic py-10">
            No products found.
        </div>
    @endforelse
</div>

<!-- Pagination -->
<div class="mt-6 flex justify-center">
    {{ $products->links('pagination::tailwind') }}
</div>

@endsection
