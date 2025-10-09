@extends('admin.layout')

@section('page-title','Add Category')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
    <h1 class="text-xl font-bold text-gray-800 mb-4">Add Category</h1>

    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label class="block font-medium text-gray-700">Category Name</label>
            <input type="text" name="name" class="w-full border rounded-lg px-3 py-2" required>
        </div>

        <div>
            <label class="block font-medium text-gray-700">Category Image</label>
            <input type="file" name="image" class="w-full border rounded-lg px-3 py-2">
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.categories') }}" class="px-4 py-2 bg-gray-200 rounded-lg mr-2">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-pink-500 text-white rounded-lg">Save</button>
        </div>
    </form>
</div>
@endsection
