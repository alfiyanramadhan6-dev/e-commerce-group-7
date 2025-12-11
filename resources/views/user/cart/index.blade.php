<x-user-layout title="Cart">

<h1 class="page-title">Your Cart</h1>

<div class="card">
    @foreach ($cartItems as $item)
        <div class="flex justify-between border-b py-3">
            <span>{{ $item['product']->name }}</span>
            <span>x{{ $item['qty'] }}</span>
        </div>
    @endforeach

    <a href="{{ route('checkout.index') }}" class="btn-primary mt-4 inline-block">
        Proceed to Checkout
    </a>
</div>

</x-user-layout>