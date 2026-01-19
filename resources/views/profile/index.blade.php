@extends('layouts.app')

@section('content')
<section class="w-full bg-gray-50 py-16 min-h-screen mt-20">
    <div class="max-w-3xl mx-auto px-4 md:px-6 lg:px-8">

        <!-- Page Heading -->
        <h2 class="text-4xl font-extrabold text-gray-900 mb-12 text-center">My Profile</h2>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-6 py-3 rounded-lg mb-8 shadow text-center font-medium">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" class="space-y-12 bg-white rounded-3xl shadow-lg p-10">
            @csrf

            <!-- Profile Information Section -->
            <div class="space-y-6">
                <h3 class="text-2xl font-bold text-gray-900 border-b border-gray-200 pb-3">Profile Information</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-500 transition">
                        @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-500 transition">
                        @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-500 transition">
                        @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Change Password Section -->
            <div class="space-y-6">
                <h3 class="text-2xl font-bold text-gray-900 border-b border-gray-200 pb-3">Change Password</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">New Password</label>
                        <input type="password" name="password"
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-500 transition">
                        @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Confirm Password</label>
                        <input type="password" name="password_confirmation"
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-500 transition">
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit"
                        class="bg-gradient-to-r from-pink-500 to-pink-600 hover:from-pink-600 hover:to-pink-700 text-white font-semibold py-3 px-8 rounded-xl shadow-md hover:shadow-lg transition">
                    Update Profile
                </button>
            </div>
        </form>
    </div>
</section>
@endsection
