@extends('admin.layout')

@section('page-title', 'Edit Product')

@section('content')
<div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-100 max-w-7xl mx-auto space-y-10">

    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <h1 class="text-3xl font-bold text-gray-800 tracking-wide">✏ Edit Product</h1>
        <a href="{{ route('admin.products') }}"
           class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-lg shadow transition">
           ← Back
        </a>
    </div>

    <!-- Notifications -->
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow mb-6">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-10">
        @csrf
        @method('PUT')

        <!-- Product Info Card -->
        <div class="bg-gray-50 border border-gray-200 rounded-2xl p-6 shadow-sm transition hover:shadow-lg">
            <h2 class="text-2xl font-bold text-gray-700 mb-6">Product Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-2">Product Name</label>
                    <input type="text" name="name" value="{{ $product->name }}"
                           class="w-full bg-white border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-300 focus:outline-none shadow-sm transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-2">Price (₹)</label>
                    <input type="number" step="0.01" name="price" value="{{ $product->price }}"
                           class="w-full bg-white border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-yellow-300 focus:outline-none shadow-sm transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-2">Stock</label>
                    <input type="number" name="stock" value="{{ $product->stock }}"
                           class="w-full bg-white border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-yellow-300 focus:outline-none shadow-sm transition">
                </div>
            </div>
        </div>

        <!-- Image Upload Card -->
        <div class="bg-gray-50 border border-gray-200 rounded-2xl p-6 shadow-sm transition hover:shadow-lg">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Product Images</h2>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                @foreach(['image1','image2','image3','image4','image5'] as $i => $img)
                <div class="relative group border-2 border-dashed border-gray-300 rounded-xl h-36 flex items-center justify-center overflow-hidden hover:border-green-500 transition-all duration-300">

                    <!-- Image Preview -->
                    <img src="{{ $product->$img ? asset('storage/'.$product->$img) : '#' }}"
                         id="preview{{ $i+1 }}"
                         class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105 {{ $product->$img ? '' : 'hidden' }}">

                    <!-- Overlay Actions -->
                    <div class="absolute inset-0 bg-black bg-opacity-30 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition">
                        <label class="cursor-pointer px-3 py-1 bg-white rounded-lg text-gray-700 font-medium shadow hover:bg-gray-100">
                            Change
                            <input type="file" name="{{ $img }}" accept="image/*" class="hidden" onchange="previewImage(event, {{ $i+1 }})">
                        </label>
                        @if($product->$img)
                        <button type="button" onclick="removeImage({{ $i+1 }})"
                                class="mt-2 px-3 py-1 bg-red-500 text-white rounded-full shadow hover:bg-red-600 transition">
                            ✕ Remove
                        </button>
                        @endif
                    </div>

                    <!-- Placeholder -->
                    @if(!$product->$img)
                        <div class="text-gray-400 text-sm text-center pointer-events-none">Click or Drag<br>to Upload</div>
                    @endif
                </div>
                @endforeach
            </div>
            <p class="text-sm text-gray-500 mt-2">Upload up to 5 images (JPG, PNG, max 2MB each).</p>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end items-center gap-4 mt-6">
            <a href="{{ route('admin.products') }}"
               class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg shadow transition">
               Cancel
            </a>
            <button type="submit"
                    class="px-6 py-2 bg-yellow-400 hover:bg-yellow-500 text-white font-semibold rounded-lg shadow-lg transition transform hover:scale-105">
                Update Product
            </button>
        </div>
    </form>
</div>

<!-- Image Preview & Remove Script -->
<script>
function previewImage(event, index) {
    const reader = new FileReader();
    reader.onload = function(){
        const img = document.getElementById('preview'+index);
        img.src = reader.result;
        img.classList.remove('hidden');
    }
    reader.readAsDataURL(event.target.files[0]);
}

function removeImage(index) {
    const img = document.getElementById('preview'+index);
    img.src = '';
    img.classList.add('hidden');
}
</script>

@endsection
