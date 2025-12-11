<x-user-layout title="Transaction Detail">

<h1 class="page-title">Invoice #{{ $transaction->id }}</h1>

<div class="card">
    <p>Status: {{ $transaction->status }}</p>

    <h3 class="font-semibold mt-3">Items</h3>
    @foreach ($transaction->items as $item)
        <p>{{ $item->product->name }} x {{ $item->qty }}</p>
    @endforeach
</div>

</x-user-layout>