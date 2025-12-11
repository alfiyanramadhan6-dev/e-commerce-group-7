<x-seller-layout title="Register Your Store">

<div class="seller-card w-full max-w-xl">

    <h2 class="text-xl font-bold mb-4">Create Your Store</h2>

    <form action="{{ route('seller.store.register') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- STORE NAME --}}
        <label class="font-medium">Store Name</label>
        <input type="text"
               name="name"
               required
               class="form-input mb-3"
               placeholder="Ex: Sweet Dessert Bakery">

        {{-- LOGO --}}
        <label class="font-medium">Store Logo</label>
        <input type="file"
               name="logo"
               accept="image/*"
               class="form-input mb-3">

        {{-- ABOUT --}}
        <label class="font-medium">About Store</label>
        <textarea name="about"
                  required
                  rows="3"
                  class="form-input mb-3"
                  placeholder="Describe your store..."></textarea>

        {{-- PHONE --}}
        <label class="font-medium">Phone Number</label>
        <input type="text"
               name="phone"
               required
               class="form-input mb-3"
               placeholder="08xxxxxxxxxx">

        {{-- CITY --}}
        <label class="font-medium">City</label>
        <input type="text"
               name="city"
               required
               class="form-input mb-3"
               placeholder="Kota">

        {{-- ADDRESS --}}
        <label class="font-medium">Full Address</label>
        <textarea name="address"
                  required
                  rows="2"
                  class="form-input mb-3"
                  placeholder="Alamat lengkap pengiriman"></textarea>

        {{-- POSTAL CODE --}}
        <label class="font-medium">Postal Code</label>
        <input type="text"
               name="postal_code"
               required
               class="form-input mb-3"
               placeholder="Kode Pos">

        <button class="seller-btn mt-3 w-full">
            Register Store
        </button>

    </form>
</div>

</x-seller-layout>