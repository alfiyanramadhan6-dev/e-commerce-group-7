@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-10">

    <h1 class="text-3xl font-bold text-[#1B1B1B] mb-6">Browse Categories</h1>

    @if ($categories->count() == 0)
        <p class="text-gray-600">No categories available.</p>
    @else

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">

            @foreach ($categories as $cat)
                <a href="{{ route('categories.products', $cat->id) }}"
                   class="bg-white p-4 rounded-xl shadow-sm border hover:shadow-md transition text-center">

                    {{-- Image --}}
                    <img src="{{ asset('storage/' . $cat->image) }}"
                         alt="{{ $cat->name }}"
                         class="w-16 h-16 mx-auto object-contain mb-3">

                    {{-- Name --}}
                    <div class="font-medium text-sm text-[#1B1B1B]">
                        {{ $cat->name }}
                    </div>

                </a>
            @endforeach

        </div>

    @endif

</div>

@endsection
