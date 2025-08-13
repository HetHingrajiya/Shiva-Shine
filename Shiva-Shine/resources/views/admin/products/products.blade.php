@extends('admin.layout')

@section('page-title', 'Product')
        
@section('content')

    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-[#633d2e] tracking-wide">Products</h1>
        <a href="{{ route('admin.products.create') }}"
            class="bg-gradient-to-r from-green-400 to-green-500 hover:from-green-500 hover:to-green-600 text-white font-semibold px-5 py-2 rounded-lg shadow-md transition-all duration-300">
            + Add Product
        </a>
    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 p-3 rounded-lg shadow mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Products Table -->
    <div class="overflow-x-auto bg-white shadow-xl rounded-xl border border-gray-200">
        <table class="min-w-full table-auto border-collapse">
            <thead class="bg-gradient-to-r from-pink-100 to-pink-100 sticky top-0 z-10">
                <tr>
                    <th class="px-6 py-3 border-b text-left text-sm font-semibold text-gray-700">#</th>
                    <th class="px-6 py-3 border-b text-left text-sm font-semibold text-gray-700">Name</th>
                    <th class="px-6 py-3 border-b text-left text-sm font-semibold text-gray-700">Price</th>
                    <th class="px-6 py-3 border-b text-left text-sm font-semibold text-gray-700">Stock</th>
                    <th class="px-6 py-3 border-b text-left text-sm font-semibold text-gray-700">Images</th>
                    <th class="px-6 py-3 border-b text-center text-sm font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($products as $index => $product)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-3 text-gray-600">{{ $loop->iteration }}</td>
                        <td class="px-6 py-3 font-medium text-[#4a2c23]">{{ $product->name }}</td>
                        <td class="px-6 py-3 text-green-600 font-semibold">₹{{ number_format($product->price, 2) }}</td>
                        <td class="px-6 py-3">{{ $product->stock }}</td>
                        <td class="px-6 py-3">
                            <div class="flex gap-2">
                                @foreach (['image1', 'image2', 'image3', 'image4', 'image5'] as $img)
                                    @if ($product->$img)
                                        <img src="{{ asset('storage/' . $product->$img) }}" alt="Product Image"
                                            class="w-10 h-10 object-cover rounded border border-gray-300 shadow-sm hover:scale-110 transition">
                                    @endif
                                @endforeach
                            </div>
                        </td>
                        <td class="px-6 py-3 flex justify-center gap-2">
                            <a href="{{ route('admin.products.edit', $product) }}"
                                class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-lg text-sm shadow transition">
                                Edit
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm shadow transition">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500 italic">
                            No products found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
