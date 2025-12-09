@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-12 grid md:grid-cols-2 gap-12">

  {{-- IMAGE --}}
  <div class="bg-white rounded-3xl shadow p-4">
    <img src="{{ $product->images->first() ? asset('storage/'.$product->images->first()->image) : '' }}"
         class="rounded-2xl w-full h-96 object-cover">
  </div>

  {{-- INFO --}}
  <div>
    <h1 class="text-4xl font-bold text-textdark mb-4">{{ $product->name }}</h1>

    <p class="text-gray-600 leading-relaxed mb-6">
      {{ $product->description }}
    </p>

    <p class="text-3xl font-semibold text-textdark mb-6">
      Rp {{ number_format($product->price,0,',','.') }}
    </p>

    <form method="POST" action="{{ route('cart.add', $product->id) }}" class="space-y-4">
      @csrf

      <label class="text-gray-600">Quantity</label>
      <input type="number" name="qty" value="1" min="1" class="border px-3 py-2 rounded-lg w-24">

      <button class="bg-sweet-400 hover:bg-sweet-500 text-white px-6 py-3 rounded-xl shadow">
        Add to Cart
      </button>
    </form>
  </div>

</div>
@endsection