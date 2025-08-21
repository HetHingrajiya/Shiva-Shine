@extends('admin.layout')

@section('page-title', 'Add Product')

@section('content')

    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-[#633d2e] tracking-wide">Add Product</h1>
        <a href="{{ route('admin.products') }}"
            class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-5 py-2 rounded-lg shadow-md transition-all duration-300">
            ← Back
        </a>
    </div>

    <!-- Success / Error Messages -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 p-3 rounded-lg shadow mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-300 text-red-800 p-3 rounded-lg shadow mb-6">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Card -->
    <div class="bg-white shadow-xl rounded-xl border border-gray-200 p-8">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Left Column -->
                <div class="space-y-6">
                    <!-- Product Name -->
                    <div>
                        <label class="block text-sm font-semibold text-[#633d2e] mb-2">Product Name</label>
                        <input type="text" name="name" placeholder="Elegant Gold Ring"
                            class="w-full bg-white border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-pink-300 focus:outline-none shadow-sm transition">
                    </div>

                    <!-- Price -->
                    <div>
                        <label class="block text-sm font-semibold text-[#633d2e] mb-2">Price (₹)</label>
                        <input type="number" step="0.01" name="price" placeholder="1999.00"
                            class="w-full bg-white border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-yellow-300 focus:outline-none shadow-sm transition">
                    </div>

                    <!-- Stock -->
                    <div>
                        <label class="block text-sm font-semibold text-[#633d2e] mb-2">Stock</label>
                        <input type="number" name="stock" placeholder="10"
                            class="w-full bg-white border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-yellow-300 focus:outline-none shadow-sm transition">
                    </div>
                </div>

                <!-- Right Column -->
                <div>
                    <label class="block text-lg font-semibold text-[#633d2e] mb-4">Product Images</label>
                    <div class="grid grid-cols-2 gap-4">
                        @for ($i = 1; $i <= 5; $i++)
                            <div class="flex flex-col items-center">
                                <input type="file" name="image{{ $i }}" accept="image/*"
                                    onchange="previewImage(event, {{ $i }})"
                                    class="w-full bg-white border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-yellow-200 focus:outline-none shadow-sm file:mr-3 file:px-3 file:py-1 file:rounded-md file:border-0 file:bg-pink-100 file:text-pink-700 hover:file:bg-pink-200 transition">
                                <img id="preview{{ $i }}" src="#" alt=""
                                    class="hidden w-24 h-24 mt-3 object-cover rounded-lg border border-gray-300 shadow-md">
                            </div>
                        @endfor
                    </div>
                    <p class="text-sm text-gray-500 mt-3">Upload up to 5 images (JPG, PNG, max 2MB each).</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end items-center pt-6 border-t border-gray-200 mt-6 gap-4">
                <a href="{{ route('admin.products') }}"
                    class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg shadow transition">
                    Cancel
                </a>
                <button type="submit"
                    class="px-6 py-2 bg-gradient-to-r from-pink-500 to-yellow-400 hover:from-pink-600 hover:to-yellow-500 text-white font-semibold rounded-lg shadow-lg transition transform hover:scale-105">
                    Save Product
                </button>
            </div>
        </form>
    </div>

    <!-- Image Preview Script -->
    <script>
        function previewImage(event, index) {
            const reader = new FileReader();
            reader.onload = function() {
                const imgElement = document.getElementById('preview' + index);
                imgElement.src = reader.result;
                imgElement.classList.remove('hidden');
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
