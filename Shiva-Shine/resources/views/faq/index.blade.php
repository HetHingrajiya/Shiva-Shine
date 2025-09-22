@extends('layouts.app')

@section('content')
<section class="py-16 min-h-screen bg-gray-50">
    <div class="max-w-4xl mx-auto px-4">
        <h1 class="text-4xl font-bold text-gray-900 mb-10 text-center">❓ Frequently Asked Questions</h1>

        <div class="space-y-4">
            <!-- FAQ Item -->
            <div x-data="{ open: false }" class="bg-white p-5 rounded-xl shadow hover:shadow-lg transition">
                <button @click="open = !open" class="w-full flex justify-between items-center text-left">
                    <h2 class="font-semibold text-gray-800 text-lg">How can I track my order?</h2>
                    <svg :class="{'rotate-180': open}" class="w-5 h-5 text-pink-500 transform transition-transform duration-300"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-transition class="mt-2 text-gray-600">
                    You can track your order from "My Orders" in your account dashboard.
                </div>
            </div>

            <!-- FAQ Item -->
            <div x-data="{ open: false }" class="bg-white p-5 rounded-xl shadow hover:shadow-lg transition">
                <button @click="open = !open" class="w-full flex justify-between items-center text-left">
                    <h2 class="font-semibold text-gray-800 text-lg">Can I cancel an order?</h2>
                    <svg :class="{'rotate-180': open}" class="w-5 h-5 text-pink-500 transform transition-transform duration-300"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-transition class="mt-2 text-gray-600">
                    Yes, orders with status 'pending' or 'confirmed' can be cancelled.
                </div>
            </div>

            <!-- FAQ Item -->
            <div x-data="{ open: false }" class="bg-white p-5 rounded-xl shadow hover:shadow-lg transition">
                <button @click="open = !open" class="w-full flex justify-between items-center text-left">
                    <h2 class="font-semibold text-gray-800 text-lg">How do I return a product?</h2>
                    <svg :class="{'rotate-180': open}" class="w-5 h-5 text-pink-500 transform transition-transform duration-300"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-transition class="mt-2 text-gray-600">
                    Go to your completed orders and click 'Return Order' to initiate a return.
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
