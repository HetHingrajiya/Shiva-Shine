@extends('layouts.app')

@section('content')
<!-- ===== My Account Dashboard ===== -->
<section class="w-full bg-gray-50 py-20 min-h-screen mt-20">
    <div class="max-w-7xl mx-auto px-4 lg:px-8 grid grid-cols-1 lg:grid-cols-4 gap-8">

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

            @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full mt-4 py-3 bg-red-500 hover:bg-red-600 text-white rounded-xl font-medium transition">
                    🚪 Logout
                </button>
            </form>
            @endauth
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
</section>
@endsection
