@extends('admin.layout')

@section('page-title', 'Products')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-lg">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-pink-800">Product List</h2>
        <a href="{{ route('admin.products.create') }}"
           class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg shadow-sm transition">
            + Add Product
        </a>
    </div>

    <!-- Products Table -->
    <div class="overflow-x-auto">
        <table class="w-full border border-gray-200 text-sm text-left">
            <thead class="bg-pink-50 border-b border-gray-200">
                <tr>
                    <th class="px-4 py-2 font-medium text-gray-600">ID</th>
                    <th class="px-4 py-2 font-medium text-gray-600">Name</th>
                    <th class="px-4 py-2 font-medium text-gray-600">Price</th>
                    <th class="px-4 py-2 font-medium text-gray-600">Stock</th>
                    <th class="px-4 py-2 font-medium text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($products as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $product->id }}</td>
                        <td class="px-4 py-2">{{ $product->name }}</td>
                        <td class="px-4 py-2">₹{{ number_format($product->price, 2) }}</td>
                        <td class="px-4 py-2">{{ $product->stock }}</td>
                        <td class="px-4 py-2 flex gap-2">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="px-3 py-1 text-xs bg-yellow-400 text-white rounded hover:bg-yellow-500">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-1 text-xs bg-red-500 text-white rounded hover:bg-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">No products found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
