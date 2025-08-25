@extends('admin.layout')

@section('page-title', 'Categories')

@section('content')

<!-- Header -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
    <div>
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">🏷️ Manage Categories</h1>
        <p class="text-gray-500 mt-1">Add, edit, or delete categories from here</p>
    </div>

    <div class="flex gap-3 flex-wrap items-center">
        <!-- Search & Filter Form -->
        <form id="filterForm" method="GET" class="flex items-center gap-2">
            <input type="text" name="search" placeholder="Search category..."
                   value="{{ request('search') }}"
                   class="border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

            <select name="gender" onchange="document.getElementById('filterForm').submit()"
                    class="border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">All Genders</option>
                <option value="Male" {{ request('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ request('gender') == 'Female' ? 'selected' : '' }}>Female</option>
            </select>

            <button type="submit"
                    class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow transition">
                🔍 Search
            </button>
        </form>

        <!-- Add Category Button -->
        <button onclick="openModal('addCategoryModal')"
                class="px-6 py-2.5 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold rounded-xl shadow-md transition duration-300">
            + Add Category
        </button>
    </div>
</div>

<!-- Notifications -->
@if(session('success'))
    <div id="successMessage" class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow mb-6">
        ✅ {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow mb-6">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Categories Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($categories as $category)
        <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1 p-6 flex flex-col justify-between">
            <div>
                <!-- Category Name -->
                <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ $category->name }}</h2>

                <!-- Gender Badge -->
                <span class="inline-block px-3 py-1 rounded-full text-xs font-medium
                             {{ $category->gender == 'Male' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                    {{ $category->gender }}
                </span>

                <!-- Dates -->
                <div class="mt-3 text-gray-400 text-xs space-y-1">
                    <p>Created: {{ $category->created_at->format('d M Y') }}</p>
                    @if($category->updated_at)
                        <p>Updated: {{ $category->updated_at->format('d M Y') }}</p>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-5 flex gap-2">
                <button onclick="openEditModal({{ $category->id }}, '{{ $category->name }}', '{{ $category->gender }}')"
                        class="flex-1 flex justify-center items-center gap-1 px-4 py-2 bg-yellow-400 hover:bg-yellow-500 text-white rounded-lg font-medium shadow transition">
                    <span>✏ Edit</span>
                </button>

                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="flex-1"
                      onsubmit="return confirm('Are you sure you want to delete this category?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-full flex justify-center items-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg font-medium shadow transition">
                        🗑 Delete
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="col-span-3 text-center text-gray-500 italic">
            No categories found.
        </div>
    @endforelse
</div>

<!-- Pagination -->
<div class="mt-8 flex justify-center">
    {{ $categories->withQueryString()->links('pagination::tailwind') }}
</div>

<!-- Add/Edit Modals -->
<!-- Add Category Modal -->
<div id="addCategoryModal" class="fixed inset-0 hidden z-50 items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md">
        <h2 class="text-2xl font-semibold mb-4">Add Category</h2>
        <form id="addCategoryForm" action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Category Name</label>
                <input type="text" name="name" required class="w-full border px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Gender</label>
                <select name="gender" required class="w-full border px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('addCategoryModal')" class="px-4 py-2 rounded-lg bg-gray-300 hover:bg-gray-400">Cancel</button>
                <button type="submit" class="px-4 py-2 rounded-lg bg-green-500 hover:bg-green-600 text-white">Add</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Category Modal -->
<div id="editCategoryModal" class="fixed inset-0 hidden z-50 items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md">
        <h2 class="text-2xl font-semibold mb-4">Edit Category</h2>
        <form id="editCategoryForm" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700">Category Name</label>
                <input type="text" name="name" id="editCategoryName" required class="w-full border px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Gender</label>
                <select name="gender" id="editCategoryGender" required class="w-full border px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('editCategoryModal')" class="px-4 py-2 rounded-lg bg-gray-300 hover:bg-gray-400">Cancel</button>
                <button type="submit" class="px-4 py-2 rounded-lg bg-yellow-400 hover:bg-yellow-500 text-white">Update</button>
            </div>
        </form>
    </div>
</div>

<!-- Scripts -->
<script>
function openModal(id) {
    document.getElementById(id).classList.remove('hidden');
    document.getElementById(id).classList.add('flex');
}

function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
    document.getElementById(id).classList.remove('flex');
}

// Pre-fill edit modal
function openEditModal(id, name, gender) {
    openModal('editCategoryModal');
    document.getElementById('editCategoryName').value = name;
    document.getElementById('editCategoryGender').value = gender;
    document.getElementById('editCategoryForm').action = "{{ url('admin/categories/update') }}/" + id;
}

// Auto-hide success message
setTimeout(() => {
    const msg = document.getElementById('successMessage');
    if(msg) msg.style.display = 'none';
}, 3000);
</script>

@endsection
