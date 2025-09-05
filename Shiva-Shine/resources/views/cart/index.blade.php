@extends('layouts.app')

@section('content')
<section class="py-16 bg-[#fffaf7] mt-16">
    <div class="max-w-7xl mx-auto px-4">

        <!-- Page Header -->
        <div class="flex justify-between items-center mb-8 flex-col sm:flex-row gap-4">
            <h2 class="text-3xl font-bold text-[#633d2e]">🛒 My Cart</h2>
            <a href="{{ route('products.all') }}"
               class="px-4 py-2 bg-[#633d2e] text-white rounded-lg hover:bg-[#4e2f23] transition">
               Continue Shopping
            </a>
        </div>

        @if($cartItems->isNotEmpty())
        <!-- Cart Table -->
        <div class="overflow-x-auto bg-white shadow rounded-xl">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Product</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Price</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Quantity</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Subtotal</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @php $total = 0; @endphp
                    @foreach($cartItems as $item)
                        @php
                            $product = $item->product;
                            $subtotal = $item->quantity * $product->price;
                            $total += $subtotal;
                        @endphp
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 flex items-center gap-4">
                                <img src="{{ asset('storage/' . $product->image1) }}"
                                     alt="{{ $product->name }}"
                                     class="w-16 h-16 object-cover rounded-lg">
                                <span class="text-gray-800 font-medium">{{ $product->name }}</span>
                            </td>
                            <td class="px-4 py-3 text-center text-[#d33f5f] font-semibold">₹{{ number_format($product->price) }}</td>
                            <td class="px-4 py-3 text-center">
                                <input type="number" min="1" value="{{ $item->quantity }}"
                                       class="w-16 text-center border rounded-md px-1 py-1 focus:ring-2 focus:ring-green-300 focus:outline-none"
                                       onchange="updateCart({{ $product->id }}, this.value)">
                            </td>
                            <td class="px-4 py-3 text-center font-medium">₹{{ number_format($subtotal, 2) }}</td>
                            <td class="px-4 py-3 text-center">
                                <button type="button"
                                        class="remove-cart-btn px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition"
                                        data-id="{{ $product->id }}">
                                    Remove
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Total Section -->
        <div class="mt-6 flex flex-col sm:flex-row justify-between items-center gap-4 p-6 bg-white rounded-xl shadow">
            <p class="text-xl md:text-2xl font-bold text-gray-800">Total: ₹{{ number_format($total, 2) }}</p>
            <div class="flex gap-4 flex-wrap">
                <a href="{{ route('products.all') }}" class="px-6 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition">Continue Shopping</a>
                <a href="#" class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">Proceed to Checkout</a>
            </div>
        </div>

        @else
        <div class="text-center py-20">
            <img src="{{ asset('images/empty-cart.png') }}" alt="Empty Cart" class="mx-auto w-48 h-48 object-contain mb-6 opacity-90">
            <h3 class="text-2xl font-bold text-[#633d2e] mb-2">Your Cart is Empty</h3>
            <p class="text-gray-600 mb-6">Add items to your cart to see them here 🛒</p>
            <a href="{{ route('products.all') }}" class="px-6 py-2 bg-[#633d2e] text-white rounded-lg hover:bg-[#4e2f23] transition">
                Browse Products
            </a>
        </div>
        @endif
    </div>
</section>

<!-- ======= Cart AJAX Script ======= -->
<script>
function updateCart(productId, quantity) {
    fetch("{{ route('cart.update') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ product_id: productId, quantity: quantity })
    })
    .then(res => res.json())
    .then(data => {
        if(data.status === 'success') location.reload();
        else alert(data.message || 'Failed to update cart.');
    })
    .catch(err => console.error(err));
}

document.querySelectorAll('.remove-cart-btn').forEach(btn => {
    btn.addEventListener('click', function(e){
        e.preventDefault();
        e.stopPropagation();
        let productId = this.dataset.id;
        let row = this.closest('tr');

        if(!confirm("Are you sure you want to remove this product?")) return;

        fetch("{{ route('cart.remove') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ product_id: productId })
        })
        .then(res => res.json())
        .then(data => {
            if(data.status === 'success'){
                row.classList.add('transition-opacity', 'opacity-0');
                setTimeout(() => row.remove(), 300);
            } else alert(data.message || 'Failed to remove product.');
        })
        .catch(err => console.error(err));
    });
});
</script>
@endsection
