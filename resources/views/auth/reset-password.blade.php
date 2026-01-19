@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
<section class="w-full bg-gray-50 py-20 min-h-screen mt-20 relative"
         x-data="{ password: '', strength: '', score: 0, loading: false }">

    <!-- Loader Overlay -->
    <div x-show="loading"
         class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm transition-opacity"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        <div class="flex flex-col items-center">
            <svg class="animate-spin h-12 w-12 text-white mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
            </svg>
            <span class="text-white font-semibold text-lg">Processing...</span>
        </div>
    </div>

    <div class="max-w-md mx-auto bg-white shadow-xl rounded-3xl p-10">
        <h1 class="text-2xl font-bold text-gray-900 mb-6 text-center">🔒 Reset Password</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4 text-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}" class="space-y-6"
              @submit.prevent="loading = true; $el.submit()">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <!-- Email -->
            <input type="email" name="email" value="{{ $email ?? old('email') }}" readonly
                   class="w-full px-4 py-2 border rounded-lg bg-gray-100 cursor-not-allowed focus:outline-none focus:ring-2 focus:ring-indigo-400">

            <!-- New Password -->
            <div class="relative">
                <input type="password" name="password" placeholder="New Password" x-model="password"
                       @input="
                           score = 0;
                           score += /[a-z]/.test(password) ? 1 : 0;
                           score += /[A-Z]/.test(password) ? 1 : 0;
                           score += /[0-9]/.test(password) ? 1 : 0;
                           score += /[^A-Za-z0-9]/.test(password) ? 1 : 0;
                           strength = password.length === 0 ? '' : score <= 1 ? 'Weak' : score <= 3 ? 'Medium' : 'Strong';
                       "
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400">

                <!-- Strength Bar -->
                <div class="mt-2 h-2 w-full rounded bg-gray-200 overflow-hidden" x-show="strength !== ''" x-transition>
                    <div class="h-2 rounded transition-all duration-300" :class="{
                        'bg-red-500 w-1/3': strength === 'Weak',
                        'bg-yellow-400 w-2/3': strength === 'Medium',
                        'bg-green-500 w-full': strength === 'Strong'
                    }"></div>
                </div>

                <!-- Strength Label -->
                <p class="mt-2 text-sm font-semibold px-3 py-1 rounded-full w-max transition-all duration-300"
                   x-show="strength !== ''" x-transition
                   :class="{
                        'bg-red-100 text-red-700': strength === 'Weak',
                        'bg-yellow-100 text-yellow-700': strength === 'Medium',
                        'bg-green-100 text-green-700': strength === 'Strong'
                   }"
                   x-text="strength">
                </p>
            </div>

            <!-- Confirm Password -->
            <input type="password" name="password_confirmation" placeholder="Confirm Password"
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400">

            <!-- Submit Button -->
            <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition flex items-center justify-center space-x-2">
                <span>Reset Password</span>
            </button>
        </form>

        <p class="mt-6 text-center text-gray-600 text-sm">
            Back to
            <a href="{{ route('account.index') }}" class="text-indigo-600 font-semibold hover:underline">Login</a>
        </p>
    </div>
</section>
@endsection
