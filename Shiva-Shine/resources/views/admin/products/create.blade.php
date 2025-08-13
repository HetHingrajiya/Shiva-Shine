@extends('admin.layout')

@section('page-title', 'Add Product')

@section('content')
    <div class="min-h-screen  from-pink-50 via-yellow-50 to-white px-4 py-10 flex justify-center items-center">

        <div
            class="w-full max-w-5xl backdrop-blur-2xl bg-white/40 border border-white/20 shadow-2xl rounded-2xl p-10 transform transition-all hover:scale-[1.01]">

            <!-- Title -->
            <h1 class="text-4xl font-extrabold text-[#633d2e] text-center mb-2 tracking-wide drop-shadow-sm">
                Add New Product
            </h1>
            <p class="text-center text-gray-500 mb-8">Fill in the information below to add a new product to your inventory.
            </p>

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <!-- Two Column Form Layout -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <!-- Left Column -->
                    <div class="space-y-6">
                        <!-- Product Name -->
                        <div>
                            <label class="block text-sm font-semibold text-[#633d2e] mb-2">Product Name</label>
                            <input type="text" name="name" placeholder="Elegant Gold Ring"
                                class="w-full bg-white/70 border border-pink-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-pink-300 focus:outline-none shadow-sm transition">
                        </div>

                        <!-- Price -->
                        <div>
                            <label class="block text-sm font-semibold text-[#633d2e] mb-2">Price (₹)</label>
                            <input type="number" step="0.01" name="price" placeholder="1999.00"
                                class="w-full bg-white/70 border border-yellow-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-yellow-300 focus:outline-none shadow-sm transition">
                        </div>

                        <!-- Stock -->
                        <div>
                            <label class="block text-sm font-semibold text-[#633d2e] mb-2">Stock</label>
                            <input type="number" name="stock" placeholder="10"
                                class="w-full bg-white/70 border border-yellow-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-yellow-300 focus:outline-none shadow-sm transition">
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
                                        class="w-full bg-white/70 border border-pink-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-yellow-200 focus:outline-none shadow-sm file:mr-3 file:px-3 file:py-1 file:rounded-md file:border-0 file:bg-pink-100 file:text-pink-700 hover:file:bg-pink-200 transition">
                                    <img id="preview{{ $i }}" src="#" alt=""
                                        class="hidden w-24 h-24 mt-3 object-cover rounded-lg border border-gray-300 shadow-md">
                                </div>
                            @endfor
                        </div>
                        <p class="text-sm text-gray-500 mt-3">Upload up to 5 images (JPG, PNG, max 2MB each).</p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between items-center pt-6 border-t border-gray-200 mt-6">
                    <a href="{{ route('admin.products') }}"
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg shadow transition">
                        ← Back
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-gradient-to-r from-pink-500 to-yellow-400 hover:from-pink-600 hover:to-yellow-500 text-white font-semibold rounded-lg shadow-lg transition transform hover:scale-105">
                        Save Product
                    </button>
                </div>
            </form>
        </div>
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
