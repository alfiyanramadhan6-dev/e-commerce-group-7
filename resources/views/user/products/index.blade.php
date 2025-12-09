@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">

  <h1 class="text-3xl font-bold text-textdark mb-6">All Desserts</h1>

  <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
    @foreach($products as $p)
      <x-product-card :product="$p" />
    @endforeach
  </div>

  <div class="mt-10">
    {{ $products->links() }}
  </div>

</div>
@endsection