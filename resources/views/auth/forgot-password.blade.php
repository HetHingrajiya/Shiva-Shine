@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
<section class="w-full bg-gray-50 py-20 min-h-screen mt-20">
    <div class="max-w-md mx-auto bg-white shadow-xl rounded-3xl p-10">
        <h1 class="text-2xl font-bold text-gray-900 mb-6 text-center">🔑 Forgot Password</h1>

        @if (session('status'))
            <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4 text-sm">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
            @csrf
            <input type="email" name="email" placeholder="Enter your email"
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">
                Send Reset Link
            </button>
        </form>

        <p class="mt-6 text-center text-gray-600 text-sm">
            Remember your password?
            <a href="{{ route('account.index') }}" class="text-indigo-600 font-semibold hover:underline">
                Back to Login
            </a>
        </p>
    </div>
</section>
@endsection
