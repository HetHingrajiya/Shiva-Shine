@component('mail::message')
# 🎉 Order Placed Successfully

Hello **{{ $order->name }}**,

Thank you for your order with **{{ config('app.name') }}**.
Your order ID is **#{{ $order->order_code }}**.

---

## 🛍️ Order Summary
@foreach ($order->items as $item)
- {{ $item->product->name }} (x{{ $item->quantity }})
  ₹{{ number_format($item->price * $item->quantity, 2) }}
@endforeach

**Total Amount:** ₹{{ number_format($order->total_amount, 2) }}

---

@if(!$order->is_confirmed)
To confirm your order, please click the button below:

@component('mail::button', ['url' => route('checkout.confirm', $order->confirmation_token)])
Confirm Order
@endcomponent
@endif

Thanks for shopping with us!
{{ config('app.name') }}
@endcomponent
