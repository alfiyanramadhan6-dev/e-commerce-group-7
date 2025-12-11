<x-user-layout title="Transactions">

<h1 class="page-title">Order History</h1>

<div class="card">
    @foreach ($transactions as $t)
        <a href="{{ route('transactions.show', $t->id) }}" class="block py-3 border-b">
            Invoice #{{ $t->id }} — {{ $t->status }}
        </a>
    @endforeach
</div>

</x-user-layout>