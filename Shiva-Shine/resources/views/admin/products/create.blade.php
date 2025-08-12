@extends('admin.layout')

@section('page-title', 'Add Product')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-lg max-w-3xl mx-auto">
    <h2 class="text-2xl font-semibold text-pink-800 mb-4">Add New Product</h2>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-600 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Product Name</label>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-pink-300 focus:border-pink-300"
                   required>
        </div>

        <!-- Price -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Price (₹)</label>
            <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-pink-300 focus:border-pink-300"
                   required>
        </div>

        <!-- Stock -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Stock</label>
            <input type="number" name="stock" value="{{ old('stock') }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-pink-300 focus:border-pink-300"
                   required>
        </div>

        <!-- Buttons -->
        <div class="flex gap-3">
            <button type="submit"
                    class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg shadow-sm transition">
                Save Product
            </button>
            <a href="{{ route('admin.products') }}"
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
