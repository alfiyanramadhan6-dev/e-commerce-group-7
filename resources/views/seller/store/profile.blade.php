<x-seller-layout title="Store Profile">

<div class="seller-card">

<form action="{{ route('seller.store.update') }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')

    <label>Name</label>
    <input type="text" name="name" class="form-input mb-3" value="{{ $store->name }}">

    <label>Logo</label>
    <input type="file" name="logo" class="form-input mb-3">

    <label>About</label>
    <textarea name="about" class="form-input mb-3">{{ $store->about }}</textarea>

    <label>Phone</label>
    <input type="text" name="phone" class="form-input mb-3" value="{{ $store->phone }}">

    <label>Address</label>
    <input type="text" name="address" class="form-input mb-3" value="{{ $store->address }}">

    <button class="seller-btn">Update Store</button>

</form>

</div>

</x-seller-layout>