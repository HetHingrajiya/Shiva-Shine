@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4">
    <div class="bg-white shadow-lg rounded-2xl p-6 sm:p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login</h2>

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Email -->
            <input type="email" name="email" placeholder="Email" required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">

            <!-- Password -->
            <input type="password" name="password" placeholder="Password" required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">

            <!-- Login Button -->
            <button type="submit"
                class="w-full bg-gray-800 text-white py-2 rounded-lg hover:bg-gray-900 transition duration-200">
                Login
            </button>
        </form>

        <!-- Divider -->
        <div class="mt-6 text-center text-gray-600">Or</div>

        <!-- Google Login -->
        <a href="{{ route('google.login') }}"
            class="mt-4 flex items-center justify-center gap-2 border border-gray-300 py-2 rounded-lg hover:bg-gray-100 transition duration-200">
            <img src="https://www.svgrepo.com/show/355037/google.svg" alt="Google" class="w-5 h-5">
            <span>Login with Google</span>
        </a>

        <!-- Register Link -->
        <p class="mt-6 text-sm text-center text-gray-600">
            Don’t have an account?
            <a href="{{ route('register') }}" class="text-gray-900 font-semibold hover:underline">Register</a>
        </p>
    </div>
</div>
@endsection
