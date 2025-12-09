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

                    {{-- Category Image --}}
                    @if ($cat->image)
                        <img src="{{ asset($cat->image) }}"
                             alt="{{ $cat->name }}"
                             class="w-16 h-16 mx-auto object-contain mb-3">
                    @else
                        <div class="w-16 h-16 bg-gray-100 rounded-lg mx-auto mb-3 flex items-center justify-center text-gray-400">
                            No Image
                        </div>
                    @endif

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