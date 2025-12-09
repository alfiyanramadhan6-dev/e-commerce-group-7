<nav x-data="{ open: false }" class="bg-white border-b">
  <div class="max-w-7xl mx-auto px-4">
    <div class="flex justify-between h-16 items-center">
      <div class="flex items-center gap-6">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
          <x-application-logo class="h-8 w-8" />
          <span class="font-semibold text-textdark">SweetMart</span>
        </a>
        <div class="hidden md:flex items-center gap-4">
          <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-textdark">Shop</a>
          <a href="{{ route('categories.index') }}" class="text-gray-600 hover:text-textdark">Categories</a>
        </div>
      </div>

      <div class="flex items-center gap-4">
        <!-- Cart link (simple) -->
        <a href="{{ route('cart.index') }}" class="text-gray-600 hover:text-textdark">
          🛒 Cart
        </a>

        @guest
          <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-textdark">Login</a>
          <a href="{{ route('register') }}" class="ml-2 bg-sweet-400 text-white px-3 py-1 rounded text-sm">Register</a>
        @endguest

        @auth
          <div class="relative" x-data="{ openMenu:false }">
            <button @click="openMenu = !openMenu" class="flex items-center gap-2 text-gray-700">
              <span>{{ Auth::user()->name }}</span>
              <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                <path d="M5.23 7.21a1 1 0 011.4-.02L10 10.58l3.37-3.39a1 1 0 111.42 1.41l-4.07 4.1a1 1 0 01-1.42 0L5.25 8.6a1 1 0 01-.02-1.39z"/>
              </svg>
            </button>

            <div x-show="openMenu" @click.outside="openMenu=false" class="absolute right-0 mt-2 w-44 bg-white border rounded shadow-sm">
              <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm hover:bg-gray-50">Profile</a>

              @if(Auth::user()->role === 'seller')
                <a href="{{ route('seller.dashboard') }}" class="block px-4 py-2 text-sm hover:bg-gray-50">Seller Dashboard</a>
              @endif

              @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm hover:bg-gray-50">Admin</a>
              @endif

              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50">Logout</button>
              </form>
            </div>
          </div>
        @endauth
      </div>
    </div>
  </div>
</nav>