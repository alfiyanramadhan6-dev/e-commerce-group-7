@extends('layouts.app')

@section('content')
  @include('components.hero')

  <div class="max-w-7xl mx-auto px-4 py-10">
    {{-- Categories --}}
    <section class="mb-10">
      <h2 class="text-2xl font-semibold mb-4">Categories</h2>
      <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
        @foreach($categories as $cat)
          <a href="{{ route('categories.products', $cat->id) }}" class="p-3 bg-white rounded shadow-sm text-center hover:shadow-md">
            <div class="text-sm font-medium text-gray-800">{{ $cat->name }}</div>
          </a>
        @endforeach
      </div>
    </section>

    {{-- Newest Products --}}
    <section>
      <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-semibold">Newest Products</h2>
        <a href="{{ route('products.index') }}" class="text-sm text-gray-600 hover:underline">View all</a>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($products as $p)
          <x-product-card :product="$p" />
        @endforeach
      </div>
    </section>
  </div>

  @include('components.footer')
@endsection