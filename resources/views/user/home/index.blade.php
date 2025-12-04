@extends('layouts.app')

@section('content')
    <h2 class="fw-bold mb-4">Featured Products</h2>

    <div class="row">
        @foreach($products as $product)
            <div class="col-md-3 mb-3">
                <div class="card">
                    <img src="{{ asset('images/default.png') }}" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="text-muted">{{ number_format($product->price) }}</p>
                        <a href="/products/{{ $product->slug }}" class="btn btn-primary w-100">View Product</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection