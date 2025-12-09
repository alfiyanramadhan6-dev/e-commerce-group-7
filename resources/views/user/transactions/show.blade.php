@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10">

    <h1 class="text-3xl font-bold mb-6">Transaction Detail</h1>

    <div class="bg-white p-6 rounded-xl shadow border mb-6">
        <p><strong>Code:</strong> {{ $transaction->code }}</p>
        <p><strong>Store:</strong> {{ $transaction->store->name }}</p>
        <p><strong>Address:</strong> {{ $transaction->address }}</p>
        <p><strong>City:</strong> {{ $transaction->city }}</p>
        <p><strong>Postal Code:</strong> {{ $transaction->postal_code }}</p>
        <p><strong>Shipping:</strong> {{ $transaction->shipping_type }}</p>
        <p><strong>Total:</strong> Rp {{ number_format($transaction->grand_total,0,',','.') }}</p>
    </div>

    <h2 class="text-2xl font-semibold mb-4">Products</h2>

    @foreach ($transaction->details as $item)
        <div class="bg-white p-4 rounded-lg shadow border mb-3">
            <p class="font-semibold">{{ $item->product->name }}</p>
            <p>Qty: {{ $item->qty }}</p>
            <p>Subtotal: Rp {{ number_format($item->subtotal,0,',','.') }}</p>
        </div>
    @endforeach

</div>
@endsection