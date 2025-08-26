@extends('admin.layout')

@section('page-title', 'Products')

@section('content')

<!-- Header -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
    <h1 class="text-3xl font-extrabold text-gray-800 tracking-wide">📦 Manage Products</h1>
    <a href="{{ route('admin.products.create') }}"
       class="px-6 py-2.5 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold rounded-xl shadow-md transition duration-300">
        + Add Product
    </a>
</div>

<!-- Success Message -->
@if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow mb-8">
        {{ session('success') }}
    </div>
@endif

<!-- Search Bar -->
<form method="GET" action="{{ route('admin.products') }}" class="mb-10">
    <div class="flex items-center max-w-2xl mx-auto bg-white shadow rounded-xl border border-gray-200 overflow-hidden">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="🔎 Search products..."
               class="w-full px-4 py-2 text-gray-700 focus:outline-none">
        <button type="submit" class="px-6 py-2 bg-gray-800 text-white hover:bg-gray-900 transition duration-300">
            Search
        </button>
    </div>
</form>

<!-- Products Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @forelse($products as $product)
        <div class="bg-white border border-gray-200 rounded-2xl shadow hover:shadow-xl transition duration-300 flex flex-col group">

            <!-- Product Image -->
            <div class="relative w-full h-56 bg-gray-100 rounded-t-2xl overflow-hidden">
                @if($product->image1)
                    <img src="{{ asset('storage/' . $product->image1) }}" alt="Product Image"
                         class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-105">
                @else
                    <div class="flex items-center justify-center h-full text-gray-400 italic">No Image</div>
                @endif

                <!-- Action Buttons -->
                <div class="absolute top-2 right-2 flex gap-2 opacity-0 group-hover:opacity-100 transition">
                    <a href="{{ route('admin.products.edit', $product) }}"
                       class="px-3 py-1 text-xs bg-yellow-500 hover:bg-yellow-600 text-white rounded-md shadow font-medium transition">
                        ✏ Edit
                    </a>
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-3 py-1 text-xs bg-red-500 hover:bg-red-600 text-white rounded-md shadow font-medium transition">
                            🗑 Delete
                        </button>
                    </form>
                </div>
            </div>

            <!-- Product Info -->
            <div class="p-5 flex-1 flex flex-col justify-between">
                <div class="space-y-3">
                    <h2 class="text-lg font-bold text-gray-800 truncate">{{ $product->name }}</h2>
                    <p class="text-xl font-extrabold text-green-600">₹{{ number_format($product->price, 2) }}</p>

                    <!-- Stock Badge -->
                    <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full
                        {{ $product->stock > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                        {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                    </span>

                    <!-- Category & Gender -->
                    <div class="mt-3 text-sm text-gray-600 space-y-1">
                        <p>📂 Category:
                            <span class="font-medium text-gray-800">
                                {{ $product->category->name ?? 'N/A' }}
                            </span>
                        </p>
                        <p>👤 Gender:
                            <span class="font-medium text-gray-800">
                                {{ $product->category->gender ?? 'N/A' }}
                            </span>
                        </p>
                    </div>

                    <!-- Info Grid -->
                    <div class="grid grid-cols-2 gap-3 mt-4 text-sm text-gray-600">
                        <p>🕒 Created: <span class="font-medium">{{ $product->created_at->format('d M Y') }}</span></p>
                        <p>🔄 Updated: <span class="font-medium">{{ $product->updated_at->format('d M Y') }}</span></p>
                    </div>
                </div>

                <!-- View Button -->
                <a href="{{ route('admin.products.show', $product) }}"
                   class="mt-6 w-full text-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg font-semibold shadow transition">
                   🔍 View Details
                </a>
            </div>
        </div>
    @empty
        <div class="col-span-3 text-center text-gray-500 italic">
            No products found.
        </div>
    @endforelse
</div>


<!-- Pagination -->
<div class="mt-10 flex justify-center">
    {{ $products->links('pagination::tailwind') }}
</div>

@endsection
