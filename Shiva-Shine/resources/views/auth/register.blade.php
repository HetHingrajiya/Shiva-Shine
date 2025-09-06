@extends('layouts.app')

@section('content')
<div class=" flex items-center justify-center min-h-screen px-4 sm:px-0">
    <div class="bg-white shadow-lg rounded-2xl p-6 sm:p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Register</h2>

        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Full Name -->
            <input type="text" name="name" placeholder="Full Name" required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">

            <!-- Email -->
            <input type="email" name="email" placeholder="Email" required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">

            <!-- Password -->
            <input type="password" name="password" placeholder="Password" required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">

            <!-- Confirm Password -->
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">

            <!-- Register Button -->
            <button type="submit"
                class="w-full bg-gray-800 text-white py-2 rounded-lg hover:bg-gray-900 transition duration-200">
                Register
            </button>
        </form>

        <!-- Login Link -->
        <p class="mt-6 text-sm text-center text-gray-600">
            Already have an account?
            <a href="{{ route('login') }}" class="text-gray-900 font-semibold hover:underline">Login</a>
        </p>
    </div>
</div>
@endsection
