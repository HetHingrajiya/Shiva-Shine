@extends('admin.layout')

@section('page-title', 'Product Details')

@section('content')

<!-- Header -->
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-gray-900 tracking-wide flex items-center gap-2">
        📦 Product Details
    </h1>
    <a href="{{ route('admin.products') }}"
       class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-lg shadow transition">
        ← Back to Products
    </a>
</div>

<!-- Product Details Card -->
<div class="bg-white shadow-xl rounded-2xl border border-gray-200 p-8">

    <!-- Product Images -->
    <h2 class="text-lg font-semibold text-gray-700 mb-4">🖼 Product Images</h2>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-10">
        @for ($i = 1; $i <= 5; $i++)
            @php $img = 'image'.$i; @endphp
            <div class="h-36 bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center border">
                @if($product->$img)
                    <img src="{{ asset('storage/' . $product->$img) }}"
                         alt="Product Image {{ $i }}"
                         class="h-full w-full object-cover object-center hover:scale-105 transition duration-300">
                @else
                    <span class="text-gray-400 italic text-sm">No Image</span>
                @endif
            </div>
        @endfor
    </div>

    <!-- Product Info -->
    <h2 class="text-lg font-semibold text-gray-700 mb-4">📋 Product Information</h2>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <tbody>
                <tr class="border-b hover:bg-gray-50">
                    <th class="py-3 px-4 font-semibold text-gray-700">Product Name</th>
                    <td class="py-3 px-4 text-gray-900">{{ $product->name }}</td>
                </tr>
                <tr class="border-b hover:bg-gray-50">
                    <th class="py-3 px-4 font-semibold text-gray-700">Price</th>
                    <td class="py-3 px-4 text-green-600 font-bold">₹{{ number_format($product->price, 2) }}</td>
                </tr>
                <tr class="border-b hover:bg-gray-50">
                    <th class="py-3 px-4 font-semibold text-gray-700">Stock</th>
                    <td class="py-3 px-4">
                        <span class="inline-block px-3 py-1 text-sm rounded-full {{ $product->stock > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                            {{ $product->stock > 0 ? 'In Stock ('.$product->stock.')' : 'Out of Stock' }}
                        </span>
                    </td>
                </tr>
                <tr class="border-b hover:bg-gray-50">
                    <th class="py-3 px-4 font-semibold text-gray-700">Category</th>
                    <td class="py-3 px-4 text-gray-900">{{ $product->category_name ?? 'N/A' }}</td>
                </tr>
                <tr class="border-b hover:bg-gray-50">
                    <th class="py-3 px-4 font-semibold text-gray-700">Gender</th>
                    <td class="py-3 px-4 text-gray-900">{{ $product->category_gender ?? 'N/A' }}</td>
                </tr>
                <!-- ✅ Short Description -->
                <tr class="border-b hover:bg-gray-50">
                    <th class="py-3 px-4 font-semibold text-gray-700">Short Description</th>
                    <td class="py-3 px-4 text-gray-600">{{ $product->short_description ?? 'N/A' }}</td>
                </tr>
                <!-- ✅ Full Description -->
                <tr class="border-b hover:bg-gray-50 align-top">
                    <th class="py-3 px-4 font-semibold text-gray-700">Description</th>
                    <td class="py-3 px-4 text-gray-600 leading-relaxed whitespace-pre-line">
                        {!! $product->description ?? 'N/A' !!}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Action Buttons -->
    <div class="flex justify-end mt-8 gap-4">
        <a href="{{ route('admin.products.edit', $product->id) }}"
           class="px-6 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold rounded-lg shadow transition">
            ✏️ Edit Product
        </a>
        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
              onsubmit="return confirm('⚠️ Are you sure you want to delete this product?');">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="px-6 py-2 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-lg shadow transition">
                🗑️ Delete Product
            </button>
        </form>
    </div>

</div>

@endsection
