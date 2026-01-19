@extends('layouts.app')

@section('content')
<section class="py-14 bg-[#fffaf7] mt-20">
    <div class="max-w-5xl mx-auto px-4">

        <!-- Order Header -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
            <div class="flex flex-col md:flex-row justify-between md:items-center gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-[#633d2e] mb-2">📦 Order Details</h2>
                    <p class="text-gray-600">Order placed on {{ $order->created_at->format('d M Y, h:i A') }}</p>
                </div>
                <div>
                    <span class="px-4 py-2 rounded-full text-sm font-semibold
                        @if($order->status === 'pending') bg-yellow-100 text-yellow-700
                        @elseif($order->status === 'completed') bg-green-100 text-green-700
                        @elseif($order->status === 'shipped') bg-blue-100 text-blue-700
                        @else bg-gray-100 text-gray-700 @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>

            <!-- Order Info -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6 text-gray-700">
                <p><strong class="text-gray-900">Order Code:</strong> {{ $order->order_code }}</p>
                <p><strong class="text-gray-900">Total Amount:</strong> ₹{{ number_format($order->total_amount, 2) }}</p>
            </div>
        </div>

        <!-- Order Items -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-xl font-semibold text-[#633d2e] mb-4">🛍️ Ordered Items</h3>
            <div class="space-y-4">
                @foreach($order->items as $item)
                    <div class="flex items-center gap-4 border-b pb-4">
                        <!-- Product Image -->
                        @if($item->product && $item->product->image1)
                            <img src="{{ asset('storage/' . $item->product->image1) }}"
                                 class="w-20 h-20 object-cover rounded-lg shadow-sm"
                                 alt="{{ $item->product->name }}">
                        @else
                            <div class="w-20 h-20 bg-gray-100 flex items-center justify-center rounded-lg text-gray-400">
                                No Image
                            </div>
                        @endif

                        <!-- Product Details -->
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-900">{{ $item->product->name ?? 'Unknown Product' }}</h4>
                            <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                            <p class="text-sm text-gray-500">Price: ₹{{ number_format($item->price, 2) }}</p>
                        </div>

                        <!-- Total per Item -->
                        <div class="text-right">
                            <p class="font-bold text-[#d33f5f]">₹{{ number_format($item->price * $item->quantity, 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Grand Total -->
            <div class="flex justify-between items-center mt-6 border-t pt-4">
                <p class="text-lg font-semibold text-gray-700">Grand Total:</p>
                <p class="text-xl font-bold text-[#d33f5f]">₹{{ number_format($order->total_amount, 2) }}</p>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-6 text-center">
            <a href="{{ route('orders.index') }}"
               class="inline-block bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-3 rounded-xl shadow hover:from-green-600 hover:to-green-700 transition font-semibold">
                ← Back to Orders
            </a>
        </div>
    </div>
</section>
@endsection
    