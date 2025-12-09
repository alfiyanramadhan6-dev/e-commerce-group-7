@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-6 py-12">

  <h1 class="text-3xl font-bold mb-8">Your Cart</h1>

  <div class="space-y-4">
    @foreach($products as $p)
      <div class="bg-white border shadow rounded-xl p-5">
        <h3 class="text-lg font-semibold">{{ $p->name }}</h3>
        <p class="text-gray-600">Qty: {{ $cart[$p->id]['qty'] }}</p>
        <p class="font-medium mt-1">
          Rp {{ number_format($p->price * $cart[$p->id]['qty'],0,',','.') }}
        </p>
      </div>
    @endforeach
  </div>

  <a href="/checkout"
     class="inline-block mt-6 bg-sweet-400 hover:bg-sweet-500 text-white px-6 py-3 rounded-xl shadow">
      Proceed to Checkout
  </a>

</div>
@endsection