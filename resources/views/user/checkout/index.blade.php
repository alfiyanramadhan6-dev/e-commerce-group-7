@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12">

  <h1 class="text-3xl font-bold mb-8">Checkout</h1>

  <form method="POST" action="{{ route('checkout.process') }}" class="space-y-6">
    @csrf

    <div>
      <label class="font-medium">Address</label>
      <input name="address" class="w-full border rounded-xl px-4 py-3 mt-1">
    </div>

    <div>
      <label class="font-medium">City</label>
      <input name="city" class="w-full border rounded-xl px-4 py-3 mt-1">
    </div>

    <div>
      <label class="font-medium">Postal Code</label>
      <input name="postal_code" class="w-full border rounded-xl px-4 py-3 mt-1">
    </div>

    <div>
      <label class="font-medium">Shipping Type</label>
      <select name="shipping_type" class="w-full border rounded-xl px-4 py-3 mt-1">
        <option value="regular">Regular</option>
        <option value="express">Express</option>
      </select>
    </div>

    <button class="bg-sweet-400 hover:bg-sweet-500 px-6 py-3 text-white rounded-xl shadow">
      Pay Now
    </button>
  </form>

</div>
@endsection