@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#FAFAFA]">

  {{-- HERO --}}
  <section class="bg-white">
    <div class="max-w-7xl mx-auto px-6 py-12 grid md:grid-cols-2 gap-8 items-center">
      <div>
        <h1 class="text-4xl md:text-5xl font-extrabold text-[#1B1B1B] leading-tight">
          SweetMart — Fresh Desserts Everyday
        </h1>
        <p class="mt-4 text-gray-600 max-w-xl">
          Pesan kue, pastry, dan dessert rumahan berkualitas. Dipanggang segar setiap hari, dikirim langsung dari toko pastry lokal.
        </p>

        <div class="mt-6 flex flex-wrap gap-3">
          <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 bg-[#A2D2FF] hover:bg-[#BDE0FE] text-[#1B1B1B] font-medium px-5 py-3 rounded-lg shadow">
            Shop Desserts
          </a>

          @guest
            <a href="{{ route('register') }}" class="inline-flex items-center gap-2 border border-[#A2D2FF] px-4 py-3 rounded-lg hover:bg-[#FAFAFA]">
              Join as Customer
            </a>
          @endguest

          @auth
            <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-2 border border-[#EDEDED] px-4 py-3 rounded-lg">
              My Account
            </a>
          @endauth
        </div>

        {{-- Key benefits --}}
        <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-4">
          <div class="bg-[#FAFAFA] p-4 rounded-lg shadow-sm border">
            <div class="font-semibold text-[#1B1B1B]">Fresh Daily</div>
            <div class="text-sm text-gray-600">Dibuat tiap hari</div>
          </div>
          <div class="bg-[#FAFAFA] p-4 rounded-lg shadow-sm border">
            <div class="font-semibold text-[#1B1B1B]">Local Sellers</div>
            <div class="text-sm text-gray-600">Dukung penjual rumahan</div>
          </div>
          <div class="bg-[#FAFAFA] p-4 rounded-lg shadow-sm border">
            <div class="font-semibold text-[#1B1B1B]">Secure Checkout</div>
            <div class="text-sm text-gray-600">Transaksi aman & cepat</div>
          </div>
        </div>
      </div>

      {{-- HERO IMAGE + mobile mockup --}}
      <div class="flex items-center justify-center">
        <div class="w-full max-w-md">
          {{-- visual phone mockup (static) --}}
          <div class="mx-auto rounded-3xl overflow-hidden shadow-2xl bg-white border" style="border-color:#EFEFEF;">
            <div class="p-4 border-b" style="border-color:#F6F6F6;">
              <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                  <div class="w-8 h-8 bg-[#A2D2FF] rounded-md"></div>
                  <div class="font-semibold text-sm">SweetMart</div>
                </div>
                <div class="text-xs text-gray-400">v1.0</div>
              </div>
            </div>

            <div class="p-4">
              {{-- mock product carousel --}}
              <div class="bg-[#FAFAFA] rounded-lg overflow-hidden">
                <img src="{{ asset('categories/7.png') }}" alt="dessert" class="w-full h-40 object-cover">
              </div>

              <div class="mt-3">
                <div class="font-semibold text-lg">Chocolate Cake Premium</div>
                <div class="text-sm text-gray-600">Rp 120.000</div>
              </div>

              <div class="mt-4 flex items-center gap-2">
                <button class="flex-1 bg-[#A2D2FF] text-[#1B1B1B] px-3 py-2 rounded-lg">Add to Cart</button>
                <button class="w-12 h-12 bg-white border rounded-lg flex items-center justify-center">
                  <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M3 3h18v2H3zM5 7h14l-1 11H6L5 7z"/>
                  </svg>
                </button>
              </div>
            </div>

            <div class="p-3 border-t text-center text-xs text-gray-400" style="border-color:#F6F6F6;">
              Secure payment • Fast delivery
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  {{-- CATEGORIES --}}
  <section class="max-w-7xl mx-auto px-6 py-10">
    <h2 class="text-2xl font-semibold text-[#1B1B1B] mb-4">Popular Categories</h2>
    <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-4">
      @foreach($categories as $cat)
        <a href="{{ route('categories.products', $cat->id) }}"
            class="block bg-white p-4 rounded-xl shadow-sm border hover:shadow-md transition text-center">
            
            <img src="{{ asset($cat->image) }}" 
                class="h-12 w-12 mx-auto mb-2 object-contain rounded-lg" 
                alt="{{ $cat->name }}">

          <div class="font-medium text-sm text-[#1B1B1B]">{{ $cat->name }}</div>
        </a>
      @endforeach
    </div>
  </section>

  {{-- FEATURED PRODUCTS --}}
  <section class="bg-white py-10">
    <div class="max-w-7xl mx-auto px-6">
      <div class="flex items-center justify-between">
        <h2 class="text-2xl font-semibold text-[#1B1B1B]">Featured Desserts</h2>
        <a href="{{ route('products.index') }}" class="text-sm text-[#1B1B1B] opacity-80 hover:opacity-100">See all</a>
      </div>

      <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($products as $p)
          <a href="{{ route('products.show', $p->id) }}" class="bg-[#FAFAFA] p-3 rounded-xl border hover:shadow transition">
            @if($p->images->first())
              <img src="{{ asset('storage/'.$p->images->first()->image) }}" class="w-full h-36 object-cover rounded-lg mb-3" alt="{{ $p->name }}">
            @else
              <div class="w-full h-36 bg-gray-100 rounded-lg mb-3 flex items-center justify-center">No Image</div>
            @endif
            <div class="font-medium text-[#1B1B1B]">{{ $p->name }}</div>
            <div class="text-sm text-gray-600 mt-1">Rp {{ number_format($p->price,0,',','.') }}</div>
          </a>
        @endforeach
      </div>
    </div>
  </section>

  {{-- HOW IT WORKS --}}
  <section class="max-w-7xl mx-auto px-6 py-12">
    <h2 class="text-2xl font-semibold mb-6">How SweetMart Works</h2>

    <div class="grid md:grid-cols-3 gap-6">
      <div class="bg-white p-6 rounded-xl border shadow-sm">
        <div class="text-3xl mb-3">🛒</div>
        <div class="font-semibold">Browse Products</div>
        <p class="text-gray-600 text-sm mt-2">Pilih dessert favoritmu dari berbagai toko pastry.</p>
      </div>

      <div class="bg-white p-6 rounded-xl border shadow-sm">
        <div class="text-3xl mb-3">💳</div>
        <div class="font-semibold">Secure Checkout</div>
        <p class="text-gray-600 text-sm mt-2">Isi alamat, pilih pengiriman, bayar. Kami proses pesananmu!</p>
      </div>

      <div class="bg-white p-6 rounded-xl border shadow-sm">
        <div class="text-3xl mb-3">🚚</div>
        <div class="font-semibold">Fast Delivery</div>
        <p class="text-gray-600 text-sm mt-2">Toko mengantarkan produk segar ke pintumu.</p>
      </div>
    </div>
  </section>

  {{-- SELLER CTA --}}
  <section class="bg-[#FFF7F9] py-12">
    <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-6">
      <div>
        <h3 class="text-2xl font-semibold">Are you a baker or pastry seller?</h3>
        <p class="text-gray-600 mt-2">Daftar toko, upload produk, dan mulai jualan di SweetMart.</p>
      </div>

      <div class="flex gap-3">
        @guest
          <a href="{{ route('register') }}" class="bg-[#A2D2FF] hover:bg-[#BDE0FE] text-[#1B1B1B] px-5 py-3 rounded-lg">Join as Seller</a>
        @endguest
        <a href="{{ route('admin.stores.index') ?? '#' }}" class="border border-[#1B1B1B] px-4 py-3 rounded-lg">Learn more</a>
      </div>
    </div>
  </section>

  {{-- TESTIMONIALS --}}
  <section class="max-w-7xl mx-auto px-6 py-12">
    <h2 class="text-2xl font-semibold mb-6">What customers say</h2>

    <div class="grid md:grid-cols-3 gap-6">
      <div class="bg-white p-6 rounded-xl border shadow-sm">
        <p class="text-gray-700">"Cake-nya lembut banget, sampai rumah masih hangat!"</p>
        <div class="mt-4 text-sm text-gray-500">— Anna, Surabaya</div>
      </div>
      <div class="bg-white p-6 rounded-xl border shadow-sm">
        <p class="text-gray-700">"Service cepat dan aman. Recommended!"</p>
        <div class="mt-4 text-sm text-gray-500">— Budi, Malang</div>
      </div>
      <div class="bg-white p-6 rounded-xl border shadow-sm">
        <p class="text-gray-700">"Seller friendly, sistemnya mudah dipakai."</p>
        <div class="mt-4 text-sm text-gray-500">— Sari, Gresik</div>
      </div>
    </div>
  </section>

  {{-- FOOTER --}}
  <footer class="bg-white border-t mt-12">
    <div class="max-w-7xl mx-auto px-6 py-8 flex flex-col md:flex-row justify-between items-start gap-6">
      <div>
        <div class="font-bold text-lg">SweetMart</div>
        <div class="text-sm text-gray-500 mt-2">Fresh desserts, local sellers, happy customers.</div>
      </div>

      <div class="grid grid-cols-2 gap-6">
        <div>
          <div class="font-semibold text-sm">Company</div>
          <a href="#" class="block text-sm text-gray-600 mt-2">About</a>
          <a href="#" class="block text-sm text-gray-600 mt-2">Careers</a>
        </div>

        <div>
          <div class="font-semibold text-sm">Support</div>
          <a href="#" class="block text-sm text-gray-600 mt-2">Help Center</a>
          <a href="#" class="block text-sm text-gray-600 mt-2">Contact</a>
        </div>
      </div>
    </div>

    <div class="border-t mt-4 border-[#F3F3F3]">
      <div class="max-w-7xl mx-auto px-6 py-4 text-sm text-gray-400">© {{ date('Y') }} SweetMart. All rights reserved.</div>
    </div>
  </footer>

</div>
@endsection