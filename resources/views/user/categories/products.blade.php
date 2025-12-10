@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-10">

    <h1 class="text-3xl font-bold mb-6">
        Produk kategori: {{ $category->name }}
    </h1>

    @if ($category->products->count() == 0)
        <p>Belum ada produk</p>
    @else

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach ($category->products as $product)
                <div class="border p-4 rounded shadow">
                    <h3 class="font-semibold">{{ $product->name }}</h3>
                    <p>Rp {{ number_format($product->price) }}</p>
                </div>
            @endforeach
        </div>

    @endif

</div>

@endsection
