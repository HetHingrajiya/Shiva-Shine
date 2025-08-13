@extends('admin.layout')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12 from-pink-50 via-yellow-50 to-white min-h-screen">

        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-4xl font-bold text-[#633d2e] drop-shadow-sm">Products</h1>
            <a href="{{ route('admin.products.create') }}"
                class="bg-gradient-to-r from-pink-300 to-yellow-200 hover:from-pink-400 hover:to-yellow-300 text-[#633d2e] font-semibold px-5 py-2 rounded-xl shadow-lg transition-all duration-300">
                + Add Product
            </a>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div
                class="bg-green-100 border border-green-300 text-green-800 p-3 rounded-lg shadow mb-6 backdrop-blur-md bg-opacity-70">
                {{ session('success') }}
            </div>
        @endif

        <!-- Products Table (Glass Effect) -->
        <div class="overflow-x-auto backdrop-blur-xl bg-white/40 shadow-2xl rounded-2xl border border-white/30">
            <table class="min-w-full text-left">
                <thead class="bg-gradient-to-r from-pink-200/60 to-yellow-100/60 border-b border-white/40">
                    <tr>
                        <th class="px-6 py-4 text-[#633d2e] font-semibold">Name</th>
                        <th class="px-6 py-4 text-[#633d2e] font-semibold">Price</th>
                        <th class="px-6 py-4 text-[#633d2e] font-semibold">Stock</th>
                        <th class="px-6 py-4 text-[#633d2e] font-semibold">Image 1</th>
                        <th class="px-6 py-4 text-[#633d2e] font-semibold">Image 2</th>
                        <th class="px-6 py-4 text-[#633d2e] font-semibold">Image 3</th>
                        <th class="px-6 py-4 text-[#633d2e] font-semibold">Image 4</th>
                        <th class="px-6 py-4 text-[#633d2e] font-semibold">Image 5</th>
                        <th class="px-6 py-4 text-center text-[#633d2e] font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr class="border-b border-white/40 hover:bg-white/40 transition-all duration-300">
                            <td class="px-6 py-4 font-medium text-[#4a2c23]">{{ $product->name }}</td>
                            <td class="px-6 py-4 text-[#4a2c23]">₹{{ number_format($product->price, 2) }}</td>
                            <td class="px-6 py-4 text-[#4a2c23]">{{ $product->stock }}</td>

                            @foreach (['image1', 'image2', 'image3', 'image4', 'image5'] as $img)
                                <td class="px-6 py-4">
                                    @if ($product->$img)
                                        <img src="{{ asset('storage/' . $product->$img) }}" alt="Product Image"
                                            class="w-14 h-14 object-cover rounded-lg border border-white shadow-md">
                                    @else
                                        <span class="text-gray-400 text-sm italic">N/A</span>
                                    @endif
                                </td>
                            @endforeach

                            <td class="px-6 py-4 flex justify-center gap-3">
                                <a href="{{ route('admin.products.edit', $product) }}"
                                    class="bg-gradient-to-r from-yellow-300 to-pink-200 hover:from-yellow-400 hover:to-pink-300 text-[#633d2e] px-4 py-2 rounded-lg shadow-md transition-all duration-300">
                                    Edit
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-gradient-to-r from-red-400 to-pink-500 hover:from-red-500 hover:to-pink-600 text-white px-4 py-2 rounded-lg shadow-md transition-all duration-300">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-4 text-center text-gray-500 italic">
                                No products found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
