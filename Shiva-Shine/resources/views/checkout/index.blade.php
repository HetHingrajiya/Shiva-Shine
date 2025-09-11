@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<section class="bg-white shadow-xl rounded-2xl p-8 max-w-3xl mx-auto mt-20 relative">
    <h1 class="text-3xl font-extrabold text-gray-800 mb-8 mt-10">🛒 Checkout</h1>

    <!-- Loader Overlay -->
    <div id="loaderOverlay"
        class="fixed inset-0 bg-black bg-opacity-40 hidden flex items-center justify-center z-50 backdrop-blur-sm">
        <div class="w-16 h-16 border-4 border-white border-t-transparent rounded-full animate-spin"></div>
    </div>

    <!-- Success Alert -->
    <div id="successAlert" class="hidden fixed inset-0 flex items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-xl p-8 text-center max-w-sm w-full">
            <svg class="w-16 h-16 mx-auto text-green-500 mb-4" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h2 class="text-xl font-semibold text-gray-800">Verification Successful!</h2>
            <p class="text-gray-600 mt-2">Your OTP has been verified. You can now place the order.</p>
            <button onclick="document.getElementById('successAlert').classList.add('hidden')"
                class="mt-5 px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                OK
            </button>
        </div>
    </div>

    <!-- Cart Items -->
    <div class="mb-8">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Your Items</h2>
        <div class="divide-y divide-gray-200">
            @foreach($cartItems as $item)
                <div class="flex justify-between py-4">
                    <div class="flex items-center space-x-4">
                        <img src="{{ $item->product->image1 ? asset('storage/' . $item->product->image1) : 'https://via.placeholder.com/80' }}"
                            class="w-16 h-16 rounded-lg border object-cover">
                        <div>
                            <p class="font-medium text-gray-800">{{ $item->product->name }}</p>
                            <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                        </div>
                    </div>
                    <p class="font-semibold text-gray-900">₹{{ number_format($item->product->price * $item->quantity, 2) }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Checkout Form -->
    <form id="checkout-form" action="{{ route('checkout.placeOrder') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Name + Phone -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Full Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" class="w-full border rounded-lg p-3" placeholder="e.g. John Doe" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Phone Number <span class="text-red-500">*</span></label>
                <input type="text" name="phone" class="w-full border rounded-lg p-3" placeholder="e.g. 9876543210" required>
            </div>
        </div>

        <!-- Address -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <input type="text" name="building" class="w-full border rounded-lg p-3" placeholder="Building Name" required>
            <input type="text" name="street" class="w-full border rounded-lg p-3" placeholder="Street Name" required>
            <input type="text" name="landmark" class="w-full border rounded-lg p-3" placeholder="Landmark">
            <input type="text" name="city" class="w-full border rounded-lg p-3" placeholder="City" required>
            <input type="text" name="state" class="w-full border rounded-lg p-3" placeholder="State" required>
            <input type="text" name="pincode" class="w-full border rounded-lg p-3" placeholder="Pincode" required>
        </div>
        <input type="hidden" name="address" id="full-address">

        <!-- Payment Method -->
        <div>
            <label class="block text-sm font-medium mb-1">Payment Method <span class="text-red-500">*</span></label>
            <select name="payment_method" class="w-full border rounded-lg p-3" required>
                <option value="">-- Select Payment Method --</option>
                <option value="cod">Cash on Delivery</option>
                <option value="online">Online Payment</option>
            </select>
        </div>

        <!-- Total -->
        <div class="flex justify-between items-center border-t pt-4">
            <p class="text-lg font-semibold text-gray-700">Total:</p>
            <p class="text-2xl font-bold text-indigo-600">₹{{ number_format($total, 2) }}</p>
        </div>

        <!-- OTP Section -->
        <div class="mt-6">
            <button type="button" id="sendOtpBtn"
                class="w-full bg-indigo-500 text-white py-3 rounded-lg font-semibold hover:bg-indigo-600 transition">
                Send OTP
            </button>

            <div id="otp-section" class="hidden mt-6 border rounded-lg p-6 bg-gray-50 text-center">
                <p class="text-gray-700 text-sm mb-4">
                    ✉️ An OTP has been sent to <strong>{{ Auth::user()->email }}</strong>.<br>
                    Please enter it below to verify.
                </p>

                <!-- OTP input boxes -->
                <div class="flex justify-center gap-3 mb-4">
                    @for ($i = 0; $i < 6; $i++)
                        <input type="text" maxlength="1"
                            class="otp-input w-12 h-12 text-center border rounded-lg text-lg font-bold focus:ring-2 focus:ring-indigo-400">
                    @endfor
                </div>

                <!-- Verify button -->
                <button type="button" id="verifyOtpBtn"
                    class="w-full bg-green-500 text-white py-3 rounded-lg font-semibold hover:bg-green-600 transition">
                    Verify OTP
                </button>

                <!-- Resend option -->
                <p class="mt-4 text-sm text-gray-600">
                    Didn’t get the OTP?
                    <button type="button" id="resendOtpBtn"
                        class="text-indigo-600 font-semibold hover:underline">
                        Resend OTP
                    </button>
                </p>

                <p id="otpMessage" class="mt-3 text-center text-sm"></p>
            </div>
        </div>

        <!-- Place Order -->
        <button type="submit" id="placeOrderBtn"
            class="w-full bg-gray-400 text-white py-3 rounded-lg font-semibold mt-6 cursor-not-allowed"
            disabled>
            Place Order
        </button>
    </form>
</section>

<script>
const loader = document.getElementById("loaderOverlay");
const successAlert = document.getElementById("successAlert");

// Merge full address
document.getElementById("checkout-form").addEventListener("submit", function () {
    let building = document.querySelector("[name='building']").value;
    let street   = document.querySelector("[name='street']").value;
    let landmark = document.querySelector("[name='landmark']").value;
    let city     = document.querySelector("[name='city']").value;
    let state    = document.querySelector("[name='state']").value;
    let pincode  = document.querySelector("[name='pincode']").value;

    document.getElementById("full-address").value =
        `${building}, ${street}${landmark ? ', ' + landmark : ''}, ${city}, ${state} - ${pincode}`;
});

// OTP input auto-move
document.querySelectorAll(".otp-input").forEach((input, index, arr) => {
    input.addEventListener("input", () => {
        if (input.value.length === 1 && index < arr.length - 1) {
            arr[index + 1].focus();
        }
    });
    input.addEventListener("keydown", (e) => {
        if (e.key === "Backspace" && !input.value && index > 0) {
            arr[index - 1].focus();
        }
    });
});

// Get OTP value
function getOtpValue() {
    return Array.from(document.querySelectorAll(".otp-input"))
        .map(i => i.value)
        .join("");
}

// Send OTP
document.getElementById("sendOtpBtn").addEventListener("click", function () {
    let btn = this;
    let msg = document.getElementById("otpMessage");
    loader.classList.remove("hidden");

    fetch("{{ route('checkout.sendOtp') }}", {
        method: 'POST',
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({})
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            msg.innerText = data.message;
            msg.className = "text-green-600 text-sm mt-3";
            btn.classList.add("hidden");
            document.getElementById("otp-section").classList.remove("hidden");
        } else {
            msg.innerText = "❌ " + data.message;
            msg.className = "text-red-600 text-sm mt-3";
        }
    })
    .finally(() => loader.classList.add("hidden"));
});

// Verify OTP
document.getElementById("verifyOtpBtn").addEventListener("click", function () {
    let otp = getOtpValue();
    let msg = document.getElementById("otpMessage");
    loader.classList.remove("hidden");

    fetch("{{ route('checkout.verifyOtp') }}", {
        method: 'POST',
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ otp: otp })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            msg.innerText = "✅ OTP Verified!";
            msg.className = "text-green-600 text-sm mt-3";
            let placeBtn = document.getElementById("placeOrderBtn");
            placeBtn.disabled = false;
            placeBtn.classList.remove("bg-gray-400", "cursor-not-allowed");
            placeBtn.classList.add("bg-indigo-600", "hover:bg-indigo-700");
            document.getElementById("otp-section").classList.add("hidden");
            successAlert.classList.remove("hidden");
        } else {
            msg.innerText = "❌ " + data.message;
            msg.className = "text-red-600 text-sm mt-3";
        }
    })
    .finally(() => loader.classList.add("hidden"));
});

// Resend OTP
document.getElementById("resendOtpBtn").addEventListener("click", function () {
    let msg = document.getElementById("otpMessage");
    loader.classList.remove("hidden");

    fetch("{{ route('checkout.sendOtp') }}", {
        method: 'POST',
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({})
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            msg.innerText = "🔄 New OTP has been sent to your email.";
            msg.className = "text-blue-600 text-sm mt-3";
            document.querySelectorAll(".otp-input").forEach(i => i.value = "");
            document.querySelector(".otp-input").focus();
        } else {
            msg.innerText = "❌ " + data.message;
            msg.className = "text-red-600 text-sm mt-3";
        }
    })
    .finally(() => loader.classList.add("hidden"));
});
</script>
@endsection
