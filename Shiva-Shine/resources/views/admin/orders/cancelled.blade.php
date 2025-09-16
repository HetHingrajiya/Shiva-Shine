@extends('admin.layout')

@section('title', 'Cancelled Orders')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">❌ Cancelled Orders</h1>

    @include('admin.orders.partials.order-list', ['orders' => $orders])
</div>
@endsection
    