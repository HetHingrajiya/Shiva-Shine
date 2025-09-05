@extends('layouts.app')

@section('content')
<section class="py-16 bg-[#fffaf7]">
    <div class="max-w-7xl mx-auto px-4 flex flex-col lg:flex-row gap-8">

        <!-- ===== Cart Items ===== -->
        <div class="flex-1" id="cart-items">
            <h2 class="text-3xl font-bold text-[#633d2e] mb-6">🛒 My Cart</h2>

            @forelse ($cartItems as $item)
                @php
                    $product = $item->product;
                @endphp

                <div class="flex flex-col sm:flex-row items-center bg-white rounded-2xl shadow p-4 mb-4 gap-4 cart-card" data-id="{{ $product->id }}" data-price="{{ $product->price }}">
                    <a href="{{ route('products.show', ['id' => Crypt::encrypt($product->id)]) }}">
                        <img src="{{ asset('storage/' . $product->image1) }}"
                             alt="{{ $product->name }}"
                             class="w-32 h-32 object-cover rounded-lg">
                    </a>

                    <div class="flex-1 flex flex-col justify-between h-full">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
                            <p class="text-[#d33f5f] font-bold mt-1 text-lg">
                                ₹{{ number_format($product->price) }}
                                <span class="line-through text-gray-400 text-sm ml-1">₹{{ number_format($product->price + 1000) }}</span>
                            </p>
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            <div class="flex items-center gap-2">
                                <label class="text-sm font-medium">Qty:</label>
                                <input type="number" min="1" value="{{ $item->quantity }}"
                                       class="w-16 text-center border rounded-md px-2 py-1 focus:ring-2 focus:ring-green-300 focus:outline-none quantity-input"
                                       data-id="{{ $product->id }}">
                            </div>

                            <button type="button"
                                    class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition remove-btn"
                                    data-id="{{ $product->id }}">
                                Remove
                            </button>
                        </div>

                        <p class="mt-2 text-gray-700 font-medium text-right subtotal" data-subtotal="{{ $item->quantity * $product->price }}">
                            Subtotal: ₹{{ number_format($item->quantity * $product->price, 2) }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="text-center py-20">
                    <img src="{{ asset('images/empty-cart.png') }}" alt="Empty Cart" class="mx-auto w-48 h-48 object-contain mb-6 opacity-90">
                    <h3 class="text-2xl font-bold text-[#633d2e] mb-2">Your Cart is Empty</h3>
                    <p class="text-gray-600 mb-6">Add items to your cart to see them here 🛒</p>
                    <a href="{{ route('products.all') }}" class="px-6 py-2 bg-[#633d2e] text-white rounded-lg hover:bg-[#4e2f23] transition">
                        Browse Products
                    </a>
                </div>
            @endforelse
        </div>

        <!-- ===== Cart Summary (Sticky) ===== -->
        @if($cartItems->isNotEmpty())
            <div class="w-full lg:w-96 bg-white rounded-2xl shadow p-6 flex flex-col gap-4 sticky top-24" id="cart-summary">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Order Summary</h3>
                <div class="flex justify-between">
                    <span>Items (<span id="summary-count">{{ $cartItems->count() }}</span>)</span>
                    <span>₹<span id="summary-total">{{ number_format($cartItems->sum(fn($i) => $i->quantity * $i->product->price), 2) }}</span></span>
                </div>
                <div class="flex justify-between border-t pt-2">
                    <span>Total</span>
                    <span class="font-bold text-lg text-gray-800">₹<span id="summary-total-final">{{ number_format($cartItems->sum(fn($i) => $i->quantity * $i->product->price), 2) }}</span></span>
                </div>

                <a href="#" class="mt-4 w-full bg-green-500 text-white text-center py-3 rounded-lg hover:bg-green-600 transition">
                    Proceed to Checkout
                </a>
                <a href="{{ route('products.all') }}" class="mt-2 w-full text-center py-2 rounded-lg bg-gray-200 hover:bg-gray-300 transition">
                    Continue Shopping
                </a>
            </div>
        @endif

    </div>
</section>

<script>
function recalcSummary() {
    let total = 0;
    let count = 0;
    document.querySelectorAll('.cart-card').forEach(card => {
        const qty = parseInt(card.querySelector('.quantity-input').value);
        const price = parseFloat(card.dataset.price);
        const subtotalEl = card.querySelector('.subtotal');
        const subtotal = qty * price;
        subtotalEl.innerHTML = `Subtotal: ₹${subtotal.toFixed(2)}`;
        subtotalEl.dataset.subtotal = subtotal;
        total += subtotal;
        count += 1;
    });
    document.getElementById('summary-total').innerText = total.toFixed(2);
    document.getElementById('summary-total-final').innerText = total.toFixed(2);
    document.getElementById('summary-count').innerText = count;
}

document.querySelectorAll('.quantity-input').forEach(input => {
    input.addEventListener('change', function() {
        const id = this.dataset.id;
        const qty = parseInt(this.value);

        fetch("{{ route('cart.update') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ product_id: id, quantity: qty })
        }).then(res => res.json())
        .then(data => {
            if(data.status === 'success') recalcSummary();
            else alert(data.message || 'Failed to update cart.');
        });
    });
});

document.querySelectorAll('.remove-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        if(!confirm("Are you sure you want to remove this product?")) return;
        const id = this.dataset.id;
        const card = this.closest('.cart-card');

        fetch("{{ route('cart.remove') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ product_id: id })
        }).then(res => res.json())
        .then(data => {
            if(data.status === 'success'){
                card.remove();
                recalcSummary();
            } else alert(data.message || 'Failed to remove product.');
        });
    });
});
</script>
@endsection
