@extends('admin.layout')

@section('title', 'Orders')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">📦 Orders</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full table-auto divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order Code</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($orders as $order)
                    <tr>
                        <td class="px-6 py-4">{{ $order->order_code }}</td>
                        <td class="px-6 py-4">{{ $order->user->name ?? 'Guest' }}</td>
                        <td class="px-6 py-4">₹{{ number_format($order->total_amount, 2) }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded text-white
                                @if($order->status == 'pending') bg-yellow-500
                                @elseif($order->status == 'completed') bg-green-500
                                @elseif($order->status == 'cancelled') bg-red-500
                                @elseif($order->status == 'processing') bg-blue-500
                                @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 space-x-2">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="text-blue-500 hover:underline">View</a>
                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
