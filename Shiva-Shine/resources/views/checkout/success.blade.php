@extends('layouts.app')

@section('content')
<section class="py-16 bg-gray-50 mt-20">
    <div class="max-w-5xl mx-auto px-4">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-3xl font-bold text-green-600 mb-6">🎉 Order Successful!</h2>

            <p class="text-gray-700 mb-6">
                Thank you for your order. Your order ID is
                <span class="font-semibold text-[#633d2e]">#{{ $order->order_code }}</span>.
            </p>

            <!-- Order Items -->
            <div class="space-y-4">
                @foreach ($order->items as $item)
                    <div class="flex items-center gap-4 p-4 bg-gray-100 rounded-lg">
                        <img src="{{ $item->product->image1 ? asset('storage/' . $item->product->image1) : 'https://via.placeholder.com/100' }}"
                             alt="{{ $item->product->name }}"
                             class="w-20 h-20 object-cover rounded-lg">
                        <div class="flex-1">
                            <h3 class="font-semibold text-lg text-gray-800">{{ $item->product->name }}</h3>
                            <p class="text-gray-600">Qty: {{ $item->quantity }}</p>
                            <p class="text-gray-800 font-semibold">₹{{ number_format($item->price * $item->quantity, 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Total -->
            <div class="mt-6 text-right">
                <p class="text-xl font-bold text-gray-800">
                    Total Paid: ₹{{ number_format($order->total_amount, 2) }}
                </p>
            </div>

            <!-- Continue Shopping -->
            <div class="mt-6 text-center">
                <a href="{{ route('products.all') }}"
                   class="px-6 py-3 bg-[#633d2e] text-white rounded-lg hover:bg-[#4e2f23] transition">
                    Continue Shopping
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
