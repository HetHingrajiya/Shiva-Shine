@extends('layouts.app')

@section('content')
<!-- ===== My Account Dashboard ===== -->
<section class="w-full bg-gray-50 py-20 min-h-screen mt-20">
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
        <!-- ===== Login/Register Popup ===== -->
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white shadow-lg rounded-2xl w-full max-w-md p-6 sm:p-8 relative">
                <!-- Tabs -->
                <div class="flex justify-center space-x-6 mb-6">
                    <button id="loginTab" class="text-lg font-semibold text-gray-900 border-b-2 border-gray-900">Login</button>
                    <button id="registerTab" class="text-lg font-semibold text-gray-500 hover:text-gray-900">Register</button>
                </div>

                <!-- Login Form -->
                <form id="loginForm" action="{{ route('login') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="email" name="email" placeholder="Email"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">
                    <input type="password" name="password" placeholder="Password"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">
                    <button type="submit"
                        class="w-full bg-gray-800 text-white py-2 rounded-lg hover:bg-gray-900 transition duration-200">
                        Login
                    </button>
                </form>

                <!-- Register Form -->
                <form id="registerForm" action="{{ route('register') }}" method="POST" class="space-y-4 hidden">
                    @csrf
                    <input type="text" name="name" placeholder="Full Name"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">
                    <input type="email" name="email" placeholder="Email"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">
                    <input type="password" name="password" placeholder="Password"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">
                    <input type="password" name="password_confirmation" placeholder="Confirm Password"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">
                    <button type="submit"
                        class="w-full bg-gray-800 text-white py-2 rounded-lg hover:bg-gray-900 transition duration-200">
                        Register
                    </button>
                </form>

                <!-- Close Button -->
                <button onclick="document.querySelector('.fixed').remove()"
                    class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
                    ✖
                </button>
            </div>
        </div>

        <!-- Script for Tab Switching -->
        <script>
            const loginTab = document.getElementById("loginTab");
            const registerTab = document.getElementById("registerTab");
            const loginForm = document.getElementById("loginForm");
            const registerForm = document.getElementById("registerForm");

            loginTab.addEventListener("click", () => {
                loginForm.classList.remove("hidden");
                registerForm.classList.add("hidden");
                loginTab.classList.add("text-gray-900", "border-b-2", "border-gray-900");
                registerTab.classList.remove("text-gray-900", "border-b-2", "border-gray-900");
                registerTab.classList.add("text-gray-500");
            });

            registerTab.addEventListener("click", () => {
                registerForm.classList.remove("hidden");
                loginForm.classList.add("hidden");
                registerTab.classList.add("text-gray-900", "border-b-2", "border-gray-900");
                loginTab.classList.remove("text-gray-900", "border-b-2", "border-gray-900");
                loginTab.classList.add("text-gray-500");
            });
        </script>
        @endguest

    </div>
</section>
@endsection
