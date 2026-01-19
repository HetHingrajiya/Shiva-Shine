@component('mail::message')
# 🔑 Confirm Your Order

Hello **{{ $order->name }}**,

Your order ID is **#{{ $order->order_code }}**.
Please use the OTP below to confirm your order:

## {{ $order->otp }}

⚠️ This OTP will expire in 10 minutes.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
