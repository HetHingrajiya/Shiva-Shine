@extends('admin.layout')

@section('title', 'Order Details')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Order Details</h1>

    <div class="bg-white shadow-lg rounded-xl p-6 space-y-6">
        <!-- Order Header -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center border-b pb-4 mb-4">
            <div>
                <p class="text-gray-500 text-sm">Order Code</p>
                <h2 class="text-2xl font-bold text-gray-800">{{ $order->order_code }}</h2>
            </div>
            <div class="mt-2 md:mt-0">
                <p class="text-gray-500 text-sm">Order Date</p>
                <p class="text-gray-700 font-medium">{{ $order->created_at->format('d M Y, H:i') }}</p>
            </div>
            <div class="mt-2 md:mt-0">
                <p class="text-gray-500 text-sm">Status</p>
                <span class="px-4 py-1 rounded-full text-white font-semibold text-sm
                    @if($order->status == 'pending') bg-yellow-500
                    @elseif($order->status == 'completed') bg-green-500
                    @elseif($order->status == 'cancelled') bg-red-500
                    @elseif($order->status == 'processing') bg-blue-500
                    @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
        </div>

        <!-- Customer & Delivery Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-b pb-4 mb-4">
            <div class="space-y-1">
                <h3 class="text-lg font-semibold text-gray-800">Customer Info</h3>
                <p><strong>Name:</strong> {{ $order->name ?? $order->user->name ?? 'Guest' }}</p>
                <p><strong>Phone:</strong> {{ $order->phone ?? 'N/A' }}</p>
                <p><strong>Email:</strong> {{ $order->user->email ?? 'N/A' }}</p>
            </div>
            <div class="space-y-1">
                <h3 class="text-lg font-semibold text-gray-800">Delivery Address</h3>
                <p>{{ $order->address }}</p>
            </div>
        </div>

        <!-- Payment Method -->
        <div class="border-b pb-4 mb-4">
            <h3 class="text-lg font-semibold text-gray-800 mb-1">Payment Method</h3>
            <p class="text-gray-700">{{ ucfirst($order->payment_method) }}</p>
        </div>

        <!-- Products Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 shadow-sm rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($order->items as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 flex items-center space-x-3">
                                <img src="{{ $item->product->image1 ? asset('storage/' . $item->product->image1) : 'https://via.placeholder.com/50' }}"
                                     class="w-12 h-12 rounded object-cover border">
                                <span class="text-gray-700 font-medium">{{ $item->product->name }}</span>
                            </td>
                            <td class="px-6 py-4 text-gray-700">₹{{ number_format($item->price, 2) }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $item->quantity }}</td>
                            <td class="px-6 py-4 font-semibold text-gray-800">₹{{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Total Amount -->
        <div class="flex justify-end items-center mt-4">
            <p class="text-2xl font-bold text-gray-800">Total: ₹{{ number_format($order->total_amount, 2) }}</p>
        </div>

        <!-- Actions -->
        <div class="flex flex-col md:flex-row justify-between mt-6 gap-3">
            <a href="{{ route('admin.orders.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded shadow text-center">Back to Orders</a>

            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this order?');" class="flex-1 md:flex-none">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded shadow">Delete Order</button>
            </form>
        </div>
    </div>
</div>
@endsection
