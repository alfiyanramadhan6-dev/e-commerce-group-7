<x-user-layout title="Checkout">

<h1 class="page-title">Checkout</h1>

<div class="card">
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf

        <input type="text" class="form-input" placeholder="Full Name" required>
        <input type="text" class="form-input mt-3" placeholder="Address" required>

        <button class="btn-primary mt-4">Place Order</button>
    </form>
</div>

</x-user-layout>