@extends('layouts.app')

@section('content')
<!-- ===== My Account Dashboard ===== -->
<section class="w-full bg-gray-50 py-20 min-h-screen mt-20"
    x-data="{ openLogin: false, openRegister: false, openForgot: false }">
    <div class="max-w-7xl mx-auto px-4 lg:px-8">

        @auth
        <!-- ===== Dashboard Content (Only for logged in users) ===== -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            <!-- Sidebar Navigation -->
            <aside class="bg-white rounded-3xl shadow-lg p-6 flex flex-col space-y-4">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Dashboard</h2>
                <p class="text-gray-600 mb-6">Welcome, <span class="font-medium">{{ Auth::user()->name }}</span></p>

                <a href="{{ route('profile.index') }}" class="block py-3 px-4 rounded-xl hover:bg-indigo-100 transition font-medium text-gray-800">
                    👤 Profile Information
                </a>
                <a href="{{ route('orders.index') }}" class="block py-3 px-4 rounded-xl hover:bg-green-100 transition font-medium text-gray-800">
                    🛒 My Orders
                </a>
                <a href="{{ route('contact.index') }}" class="block py-3 px-4 rounded-xl hover:bg-indigo-100 transition font-medium text-gray-800">
                    📩 Contact Support
                </a>
                <a href="{{ route('faq.index') }}" class="block py-3 px-4 rounded-xl hover:bg-yellow-100 transition font-medium text-gray-800">
                    ❓ FAQ & Help
                </a>
                <a href="{{ route('support.chat') }}" class="block py-3 px-4 rounded-xl hover:bg-green-100 transition font-medium text-gray-800">
                    💬 Live Support Chat
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full mt-4 py-3 bg-red-500 hover:bg-red-600 text-white rounded-xl font-medium transition">
                        🚪 Logout
                    </button>
                </form>
            </aside>

            <!-- Main Content -->
            <main class="lg:col-span-3 flex flex-col space-y-8">
                <!-- Profile Card -->
                <div class="bg-white rounded-3xl shadow-lg p-8">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-6">👤 Your Profile</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-gray-600 mb-2"><span class="font-medium">Name:</span> {{ Auth::user()->name }}</p>
                            <p class="text-gray-600 mb-2"><span class="font-medium">Email:</span> {{ Auth::user()->email }}</p>
                            <p class="text-gray-600 mb-2"><span class="font-medium">Phone:</span> {{ Auth::user()->phone ?? 'Not set' }}</p>
                        </div>
                        <div class="flex items-center justify-end">
                            <a href="{{ route('profile.index') }}" class="px-6 py-3 bg-indigo-500 text-white rounded-xl hover:bg-indigo-600 transition font-medium">
                                Edit Profile
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Orders Summary -->
                <div class="bg-white rounded-3xl shadow-lg p-8">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-6">🛒 Orders Summary</h2>
                    <p class="text-gray-600">Quick access to your recent orders and order history.</p>
                    <a href="{{ route('orders.index') }}" class="mt-4 inline-block px-6 py-3 bg-green-500 text-white rounded-xl hover:bg-green-600 transition font-medium">
                        View Orders
                    </a>
                </div>

                <!-- Support Section -->
                <div class="bg-white rounded-3xl shadow-lg p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex flex-col justify-between">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">📩 Contact Support</h2>
                        <p class="text-gray-600 mb-4">Get help or support for any issues or queries with your account or orders.</p>
                        <a href="{{ route('contact.index') }}" class="px-6 py-3 bg-indigo-500 text-white rounded-xl hover:bg-indigo-600 transition font-medium">
                            Contact Support
                        </a>
                    </div>
                    <div class="flex flex-col justify-between">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">💬 Live Chat</h2>
                        <p class="text-gray-600 mb-4">Chat instantly with our support team for any guidance you need.</p>
                        <a href="{{ route('support.chat') }}" class="px-6 py-3 bg-green-500 text-white rounded-xl hover:bg-green-600 transition font-medium">
                            Start Chat
                        </a>
                    </div>
                </div>
            </main>
        </div>
        @endauth


        @guest
        <!-- ===== Login Prompt for Guests ===== -->
        <div class="flex justify-center">
            <div class="bg-white shadow-xl rounded-3xl p-10 text-center max-w-md w-full">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">🔒 Please Login</h2>
                <p class="text-gray-600 mb-6">You need to log in to access your dashboard and account features.</p>
                <button @click="openLogin = true" class="px-6 py-3 bg-indigo-500 text-white rounded-xl hover:bg-indigo-600 transition font-medium">
                    Login Now
                </button>
                <p class="mt-4 text-gray-600">Don't have an account?
                    <button @click="openRegister = true" class="text-indigo-600 font-semibold hover:underline">Register</button>
                </p>
            </div>
        </div>
        @endguest

    </div>

    <!-- ===== Login Modal ===== -->
    <div x-show="openLogin" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50" x-cloak>
        <div class="bg-white shadow-lg rounded-2xl p-6 sm:p-8 w-full sm:w-96 relative">
            <button @click="openLogin = false" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">✖</button>
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login</h2>

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                <input type="email" name="email" placeholder="Email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400">
                <input type="password" name="password" placeholder="Password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400">
                <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">Login</button>
            </form>

            <!-- Forgot Password -->
            <div class="text-right mt-2">
                <button @click="openLogin = false; openForgot = true" class="text-sm text-indigo-600 hover:underline">
                    Forgot Password?
                </button>
            </div>

            <div class="mt-4 text-center text-gray-600">Or</div>

            <a href="{{ route('google.login') }}" class="mt-4 flex items-center justify-center gap-2 border border-gray-300 py-2 rounded-lg hover:bg-gray-100 transition">
                <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-5 h-5">
                Login with Google
            </a>

            <p class="mt-4 text-sm text-center text-gray-600">
                Don’t have an account?
                <button @click="openLogin = false; openRegister = true" class="text-indigo-600 font-semibold hover:underline">Register</button>
            </p>
        </div>
    </div>

    <!-- ===== Register Modal ===== -->
    <div x-show="openRegister" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50" x-cloak>
        <div class="bg-white shadow-lg rounded-2xl p-6 sm:p-8 w-full sm:w-96 relative">
            <button @click="openRegister = false" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">✖</button>
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Register</h2>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf
                <input type="text" name="name" placeholder="Full Name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400">
                <input type="email" name="email" placeholder="Email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400">
                <input type="password" name="password" placeholder="Password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400">
                <input type="password" name="password_confirmation" placeholder="Confirm Password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400">
                <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">Register</button>
            </form>

            <div class="mt-4 text-center text-gray-600">Or</div>

            <a href="{{ route('google.login') }}" class="mt-4 flex items-center justify-center gap-2 border border-gray-300 py-2 rounded-lg hover:bg-gray-100 transition">
                <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-5 h-5">
                Register with Google
            </a>

            <p class="mt-4 text-sm text-center text-gray-600">
                Already have an account?
                <button @click="openRegister = false; openLogin = true" class="text-indigo-600 font-semibold hover:underline">Login</button>
            </p>
        </div>
    </div>

<!-- ===== Forgot Password Modal ===== -->
<div x-show="openForgot" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50" x-cloak>
    <div class="bg-white shadow-lg rounded-2xl p-6 sm:p-8 w-full sm:w-96 relative"
         x-data="{ loading: false, success: '', error: '' }">

        <button @click="openForgot = false" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">✖</button>
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Forgot Password</h2>

        <form id="forgotForm"
              @submit.prevent="
                loading = true;
                success = '';
                error = '';
                fetch('{{ route('password.email') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',   // Important for Laravel to return JSON
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
                    },
                    body: JSON.stringify({ email: $refs.email.value })
                })
                .then(res => res.json())
                .then(data => {
                    loading = false;
                    if (data.status) {
                        success = data.status;
                        $refs.email.value = ''; // clear email field
                    } else if (data.errors && data.errors.email) {
                        error = data.errors.email[0];
                    }
                })
                .catch(err => {
                    console.error(err);
                    loading = false;
                    error = 'Something went wrong. Try again.';
                });
              "
              class="space-y-4">

            @csrf
            <input x-ref="email" type="email" name="email" placeholder="Enter your email"
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400">

            <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition flex justify-center items-center gap-2">
                <span x-show="!loading">Send Reset Link</span>
            </button>

            <!-- Success / Error Message -->
            <div class="mt-4 text-center">
                <p x-text="success" class="text-green-600 font-semibold" x-show="success"></p>
                <p x-text="error" class="text-red-600 font-semibold" x-show="error"></p>
            </div>

            <p class="mt-4 text-sm text-center text-gray-600">
                Remembered your password?
                <button @click="openForgot = false; openLogin = true" class="text-indigo-600 font-semibold hover:underline">
                    Back to Login
                </button>
            </p>
        </form>

        <!-- Fullscreen Loader -->
        <div x-show="loading" class="fixed inset-0 bg-black bg-opacity-40 backdrop-blur-sm flex items-center justify-center z-50">
            <div class="border-8 border-gray-300 border-t-indigo-600 rounded-full w-16 h-16 animate-spin"></div>
        </div>
    </div>
</div>



</section>
@endsection
