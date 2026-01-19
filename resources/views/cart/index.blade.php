@extends('layouts.app')

@section('content')
<section class="py-16 bg-[#fffaf7] mt-20">
    <div class="max-w-7xl mx-auto px-4">

        <h2 class="text-3xl font-bold text-[#633d2e] mb-6">🛒 My Cart</h2>

        @if($cartItems->isNotEmpty())
        <!-- ===== Desktop Table View ===== -->
        <div class="hidden md:block overflow-x-auto bg-white shadow rounded-xl">
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
                    @foreach ($cartItems as $item)
                        @php
                            $product = $item->product;
                            $quantity = $item->quantity ?? 1;
                            $subtotal = $product->price * $quantity;
                            $total += $subtotal;
                        @endphp
                        <tr class="cart-item" data-id="{{ $product->id }}" data-price="{{ $product->price }}">
                            <!-- Product -->
                            <td class="px-4 py-3 flex items-center gap-4">
                                <a href="{{ route('products.show', ['id' => Crypt::encrypt($product->id)]) }}">
                                    <img src="{{ asset('storage/' . $product->image1) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded-lg">
                                </a>
                                <span class="text-gray-800 font-medium">{{ $product->name }}</span>
                            </td>

                            <!-- Price -->
                            <td class="px-4 py-3 text-center text-[#d33f5f] font-semibold">₹{{ number_format($product->price) }}</td>

                            <!-- Quantity -->
                            <td class="px-4 py-3 text-center">
                                <input type="number" min="1" value="{{ $quantity }}" class="w-16 text-center border rounded-md px-1 py-1 focus:ring-2 focus:ring-green-300 focus:outline-none quantity-input">
                            </td>

                            <!-- Subtotal -->
                            <td class="px-4 py-3 text-center font-medium">
                                ₹<span class="subtotal">{{ number_format($subtotal, 2) }}</span>
                            </td>

                            <!-- Remove -->
                            <td class="px-4 py-3 text-center">
                                <button type="button" class="remove-cart-btn px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">
                                    Remove
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- ===== Mobile Card View ===== -->
        <div class="md:hidden space-y-4">
            @foreach ($cartItems as $item)
                @php
                    $product = $item->product;
                    $quantity = $item->quantity ?? 1;
                    $subtotal = $product->price * $quantity;
                @endphp
                <div class="bg-white rounded-xl shadow p-4 flex flex-col gap-4 cart-item" data-id="{{ $product->id }}" data-price="{{ $product->price }}">
                    <div class="flex justify-between items-center">
                        <h3 class="text-gray-800 font-semibold text-lg">{{ $product->name }}</h3>
                        <button type="button" class="remove-cart-btn px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">Remove</button>
                    </div>
                    <div class="flex gap-4 items-center">
                        <img src="{{ asset('storage/' . $product->image1) }}" alt="{{ $product->name }}" class="w-24 h-24 object-cover rounded-lg">
                        <div class="flex-1 flex flex-col gap-2">
                            <p class="text-[#d33f5f] font-semibold text-lg">₹{{ number_format($product->price) }}</p>
                            <div class="flex items-center gap-2">
                                <label class="text-sm font-medium">Qty:</label>
                                <input type="number" min="1" value="{{ $quantity }}" class="w-16 text-center border rounded-md px-1 py-1 focus:ring-2 focus:ring-green-300 focus:outline-none quantity-input">
                            </div>
                            <p class="text-gray-700 font-medium text-right">Subtotal: ₹<span class="subtotal">{{ number_format($subtotal, 2) }}</span></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- ===== Total Section ===== -->
        <div class="mt-8 bg-white rounded-2xl shadow-lg p-6 flex flex-col sm:flex-row justify-between items-center gap-6">
            <!-- Total Price -->
            <div class="text-center sm:text-left">
                <p class="text-lg text-gray-600">Grand Total</p>
                <p class="text-2xl md:text-3xl font-extrabold text-[#633d2e] mt-1">
                    ₹<span id="cart-total">{{ number_format($total, 2) }}</span>
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-4 flex-wrap justify-center sm:justify-end">
                <!-- Continue Shopping -->
                <a href="{{ route('products.all') }}"
                   class="px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-xl shadow hover:bg-gray-200 transition">
                    ← Continue Shopping
                </a>

                <!-- Proceed to Checkout -->
                <a href="{{ route('checkout.index') }}"
                   class="px-8 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold rounded-xl shadow hover:from-green-600 hover:to-green-700 transition">
                    Proceed to Checkout →
                </a>
            </div>
        </div>


        @else
            <div class="text-center py-20">
                <img src="{{ asset('https://cdn-icons-png.flaticon.com/512/11329/11329060.png') }}" alt="Empty Cart" class="mx-auto w-48 h-48 object-contain mb-6 opacity-90">
                <h3 class="text-2xl font-bold text-[#633d2e] mb-2">Your Cart is Empty</h3>
                <p class="text-gray-600 mb-6">Add items to your cart to see them here 🛒</p>
                <a href="{{ route('products.all') }}" class="px-6 py-2 bg-[#633d2e] text-white rounded-lg hover:bg-[#4e2f23] transition">Browse Products</a>
            </div>
        @endif

    </div>
</section>

<!-- ===== Custom Confirmation Modal ===== -->
<div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
  <div class="bg-white rounded-xl shadow-xl p-6 max-w-md w-full text-center">
      <h2 class="text-lg font-semibold text-gray-800 mb-4">Remove Product</h2>
      <p class="text-gray-600 mb-6">Are you sure you want to remove this product from your cart?</p>
      <div class="flex justify-center gap-4">
          <button id="confirmYes" class="px-5 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Yes, Remove</button>
          <button id="confirmNo" class="px-5 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">Cancel</button>
      </div>
  </div>
</div>

<script>
// Recalculate subtotal and total only for visible cart items
function recalculateCart() {
    let total = 0;
    document.querySelectorAll('.cart-item').forEach(item => {
        if(item.offsetParent !== null) {
            const price = parseFloat(item.dataset.price);
            const qtyInput = item.querySelector('.quantity-input');
            const quantity = parseInt(qtyInput.value) || 1;
            const subtotal = price * quantity;
            item.querySelector('.subtotal').innerText = subtotal.toFixed(2);
            total += subtotal;
        }
    });
    document.getElementById('cart-total').innerText = total.toFixed(2);
}

// Update backend via AJAX
function updateCart(productId, quantity) {
    fetch("{{ route('cart.update') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ product_id: productId, quantity: quantity })
    }).then(res => res.json())
      .then(data => { if(data.status !== 'success') alert(data.message || 'Failed to update cart.'); })
      .catch(err => console.error(err));
}

// Quantity change event
document.querySelectorAll('.quantity-input').forEach(input => {
    input.addEventListener('input', function() {
        const productId = this.closest('.cart-item').dataset.id;
        const quantity = parseInt(this.value) || 1;
        recalculateCart();
        updateCart(productId, quantity);
    });
});

// ===== Custom Confirmation Modal Handling =====
let productToRemove = null;

document.querySelectorAll('.remove-cart-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        productToRemove = this.closest('.cart-item').dataset.id;
        document.getElementById('confirmModal').classList.remove('hidden');
        document.getElementById('confirmModal').classList.add('flex');
    });
});

document.getElementById('confirmNo').addEventListener('click', function() {
    document.getElementById('confirmModal').classList.add('hidden');
    document.getElementById('confirmModal').classList.remove('flex');
});

document.getElementById('confirmYes').addEventListener('click', function() {
    if(!productToRemove) return;
    fetch("{{ route('cart.remove') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ product_id: productToRemove })
    }).then(res => res.json())
      .then(data => {
          if(data.status === 'success') {
              document.querySelectorAll(`.cart-item[data-id="${productToRemove}"]`).forEach(el => el.remove());
              recalculateCart();
          } else {
              alert(data.message || 'Failed to remove product.');
          }
          productToRemove = null;
          document.getElementById('confirmModal').classList.add('hidden');
          document.getElementById('confirmModal').classList.remove('flex');
      }).catch(err => console.error(err));
});

// Initial calculation
recalculateCart();
</script>
@endsection
