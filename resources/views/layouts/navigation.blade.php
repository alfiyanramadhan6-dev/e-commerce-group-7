<nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            {{-- LEFT — LOGO --}}
            <a href="{{ route('landing') }}" class="flex items-center gap-2">
                <img src="{{ asset('logo/logo-landscape.png') }}"
                     alt="SweetMart Logo"
                     class="h-8 object-contain">
            </a>

            {{-- CENTER — MENU --}}
            <div class="hidden md:flex gap-6 text-[15px] font-medium text-textdark">

                {{-- ADMIN --}} 
                @if(auth()->check() && auth()->user()->role === 'admin')

                    <a href="{{ route('admin.dashboard') }}" class="hover:text-sweet-400 transition">Dashboard</a>
                    <a href="{{ route('admin.stores.index') }}" class="hover:text-sweet-400 transition">Stores</a>
                    <a href="{{ route('admin.users.index') }}" class="hover:text-sweet-400 transition">Users</a>

                @else
                    {{-- GENERAL MENU --}}
                    <a href="{{ route('landing') }}" class="hover:text-sweet-400 transition">Home</a>
                    <a href="{{ route('categories.index') }}" class="hover:text-sweet-400 transition">Categories</a>
                    <a href="{{ route('products.index') }}" class="hover:text-sweet-400 transition">Products</a>
                @endif

            </div>

            {{-- RIGHT — ACTION BUTTONS --}}
            <div class="hidden md:flex items-center gap-4">

                {{-- CART ICON (member & seller) --}}
                @auth
                    @if(in_array(auth()->user()->role, ['member', 'seller']))
                        <a href="{{ route('cart.index') }}" class="relative">
                            <svg class="w-7 h-7 text-textdark hover:text-sweet-400 transition"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l1.293 5.293a1 1 0 01-.948 1.207H5
                                      a1 1 0 01-1-1m4 0h6m0 0l1.293-5.293
                                      M17 18a2 2 0 11-4 0m6 0a2 2 0 11-4 0" />
                            </path>
                            </svg>
                        </a>
                    @endif
                @endauth


                {{-- ROLE BUTTONS (Become a Seller / My Store / Admin) --}}
                @auth
                    {{-- MEMBER → Become a Seller --}}
                    @if(auth()->user()->role === 'member')
                        <a href="{{ route('seller.store.profile') }}"
                           class="px-4 py-2 border border-sweet-400 text-sweet-400 rounded-lg hover:bg-sweet-50 transition">
                            Become a Seller
                        </a>
                    @endif

                    {{-- SELLER → My Store --}}
                    @if(auth()->user()->role === 'seller')
                        <a href="{{ route('seller.dashboard') }}"
                           class="px-4 py-2 border border-sweet-400 text-sweet-400 rounded-lg hover:bg-sweet-50 transition">
                            My Store
                        </a>
                    @endif

                    {{-- ADMIN → No Seller Buttons --}}
                @else
                    {{-- GUEST --}}
                    <a href="{{ route('login') }}"
                       class="px-4 py-2 bg-sweet-400 text-white rounded-lg hover:bg-sweet-500 transition">
                       Login
                    </a>

                    <a href="{{ route('register') }}"
                       class="px-4 py-2 border border-sweet-400 text-sweet-400 rounded-lg hover:bg-sweet-50 transition">
                       Register
                    </a>
                @endauth


                {{-- PROFILE DROPDOWN --}}
                @auth
                    <div x-data="{ open: false }" class="relative">

                        {{-- BUTTON --}}
                        <button
                            @click="open = !open"
                            class="px-4 py-2 bg-sweet-400 text-white rounded-lg hover:bg-sweet-500 transition"
                        >
                            {{ auth()->user()->name }}
                        </button>

                        {{-- DROPDOWN --}}
                        <div
                            x-show="open"
                            @click.away="open = false"
                            class="absolute right-0 mt-2 w-44 bg-white shadow-lg rounded-lg py-2 z-50"
                        >
                            <a href="{{ route('profile.edit') }}"
                               class="block px-4 py-2 text-sm hover:bg-softgray">
                                Profile
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button
                                    class="w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-softgray">
                                    Logout
                                </button>
                            </form>
                        </div>

                    </div>
                @endauth

            </div>


            {{-- MOBILE MENU BUTTON --}}
            <div class="md:hidden">
                <button onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                    <svg class="w-7 h-7 text-textdark" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    {{-- MOBILE MENU --}}
    <div id="mobile-menu" class="hidden md:hidden px-4 pb-4 mt-2">
        <div class="flex flex-col gap-3 text-textdark">

            {{-- ADMIN --}} 
            @auth
                @if(auth()->user()->role === 'admin')

                    <a href="{{ route('admin.dashboard') }}" class="py-2 border-b">Dashboard</a>
                    <a href="{{ route('admin.stores.index') }}" class="py-2 border-b">Stores</a>
                    <a href="{{ route('admin.users.index') }}" class="py-2 border-b">Users</a>

                @else
                    {{-- GENERAL --}}
                    <a href="{{ route('landing') }}" class="py-2 border-b">Home</a>
                    <a href="{{ route('categories.index') }}" class="py-2 border-b">Categories</a>
                    <a href="{{ route('products.index') }}" class="py-2 border-b">Products</a>

                    @if(auth()->user()->role === 'member')
                        <a href="{{ route('seller.store.profile') }}" class="py-2 border-b">Become a Seller</a>
                    @endif

                    @if(auth()->user()->role === 'seller')
                        <a href="{{ route('seller.dashboard') }}" class="py-2 border-b">My Store</a>
                    @endif

                    @if(in_array(auth()->user()->role, ['member', 'seller']))
                        <a href="{{ route('cart.index') }}" class="py-2 border-b">Cart</a>
                    @endif

                @endif

                <a href="{{ route('profile.edit') }}" class="py-2 border-b">Profile</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="py-2 text-left text-red-500">Logout</button>
                </form>

            @else
                {{-- GUEST --}}
                <a href="{{ route('landing') }}" class="py-2 border-b">Home</a>
                <a href="{{ route('categories.index') }}" class="py-2 border-b">Categories</a>
                <a href="{{ route('products.index') }}" class="py-2 border-b">Products</a>
                <a href="{{ route('login') }}" class="py-2 border-b">Login</a>
                <a href="{{ route('register') }}" class="py-2 border-b">Register</a>
            @endauth

        </div>
    </div>
</nav>