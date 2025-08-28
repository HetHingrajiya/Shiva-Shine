@extends('admin.layout')

@section('page-title', 'Add Product')

@section('content')

<!-- Header -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
    <div>
        <h1 class="text-3xl font-bold text-gray-900 tracking-wide">Add Product</h1>
        <p class="text-gray-500 mt-1">Create a new product and assign it to a category</p>
    </div>
    <a href="{{ route('admin.products') }}"
       class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-lg shadow transition">
       ← Back
    </a>
</div>

<!-- Messages -->
@if (session('success'))
    <div class="bg-green-100 border border-green-300 text-green-800 p-4 rounded-lg shadow mb-6">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="bg-red-100 border border-red-300 text-red-800 p-4 rounded-lg shadow mb-6">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Form Card -->
<div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-8">
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Left Column -->
            <div class="space-y-6">
                <!-- Product Name -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Product Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" placeholder="Elegant Gold Ring" required
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none shadow-sm">
                </div>

                <!-- Price -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Price (₹) <span class="text-red-500">*</span></label>
                    <input type="number" step="0.01" name="price" placeholder="1999.00" required min="0"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-yellow-400 focus:outline-none shadow-sm">
                </div>

                <!-- Stock -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Stock <span class="text-red-500">*</span></label>
                    <input type="number" name="stock" placeholder="10" required min="0"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none shadow-sm">
                </div>

                <!-- Gender & Category -->
                <div class="grid grid-cols-2 gap-4">
                    <!-- Gender -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Gender <span class="text-red-500">*</span></label>
                        <select name="gender" id="genderSelect" onchange="filterCategories()" required
                                class="w-full border border-gray-300 rounded-xl px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none shadow-sm">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Category <span class="text-red-500">*</span></label>
                        <select name="category_id" id="categorySelect" required
                                class="w-full border border-gray-300 rounded-xl px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none shadow-sm">
                            <option value="">Select Category</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" data-gender="{{ $cat->gender }}">
                                    {{ $cat->name }} ({{ $cat->gender }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Right Column: Product Images -->
            <div>
                <label class="block text-lg font-semibold text-gray-700 mb-4">Product Images</label>
                <div class="grid grid-cols-2 gap-4">
                    @for ($i = 1; $i <= 5; $i++)
                        <div class="flex flex-col items-center">
                            <input type="file" name="image{{ $i }}" accept="image/*"
                                onchange="previewImage(event, {{ $i }})"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-pink-300 focus:outline-none shadow-sm file:mr-3 file:px-3 file:py-1 file:rounded-md file:border-0 file:bg-pink-100 file:text-pink-700 hover:file:bg-pink-200 transition"
                                {{ $i === 1 ? 'required' : '' }}>
                            <img id="preview{{ $i }}" src="#" alt=""
                                 class="hidden w-24 h-24 mt-3 object-cover rounded-lg border border-gray-300 shadow-md">
                        </div>
                    @endfor
                </div>
                <p class="text-sm text-gray-500 mt-3">Upload up to 5 images (JPG, PNG, max 2MB each). First image is required.</p>
            </div>

        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end items-center pt-6 border-t border-gray-200 mt-6 gap-4">
            <a href="{{ route('admin.products') }}"
               class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg shadow transition">
               Cancel
            </a>
            <button type="submit"
                    class="px-6 py-2 bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white font-semibold rounded-xl shadow-lg transition transform hover:scale-105">
                Save Product
            </button>
        </div>
    </form>
</div>

<!-- Scripts -->
<script>
    // Image preview
    function previewImage(event, index) {
        const reader = new FileReader();
        reader.onload = function() {
            const img = document.getElementById('preview' + index);
            img.src = reader.result;
            img.classList.remove('hidden');
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    // Filter categories based on gender
    function filterCategories() {
        const gender = document.getElementById('genderSelect').value;
        const categorySelect = document.getElementById('categorySelect');
        const options = categorySelect.querySelectorAll('option');

        options.forEach(option => {
            if (option.value === "") return; // placeholder
            option.style.display = (gender === "" || option.dataset.gender === gender) ? "block" : "none";
        });

        categorySelect.value = "";
    }
</script>

@endsection
