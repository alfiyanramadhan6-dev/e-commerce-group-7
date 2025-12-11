<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    /**
     * Ambil data profil store milik user login.
     */
    public function profile()
    {
        $store = Store::where('user_id', Auth::id())->firstOrFail();

        return response()->json([
            'success' => true,
            'data'    => $store
        ]);
    }

    /**
     * Update profil store.
     */
    public function update(Request $request)
    {
        $store = Store::where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'name'        => 'required|string|max:255',
            'logo'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'about'       => 'required|string',
            'phone'       => 'required|string|max:20',
            'address_id'  => 'required|string|max:100',
            'city'        => 'required|string|max:100',
            'address'     => 'required|string',
            'postal_code' => 'required|string|max:10',
        ]);

        // Upload logo baru
        if ($request->hasFile('logo')) {

            if ($store->logo && Storage::disk('public')->exists($store->logo)) {
                Storage::disk('public')->delete($store->logo);
            }

            $logoPath = $request->file('logo')->store('stores', 'public');
            $store->logo = $logoPath;
        }

        $store->update([
            'name'        => $request->name,
            'about'       => $request->about,
            'phone'       => $request->phone,
            'address_id'  => $request->address_id,
            'city'        => $request->city,
            'address'     => $request->address,
            'postal_code' => $request->postal_code,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Profil toko berhasil diperbarui',
            'data'    => $store
        ]);
    }

    /**
     * Halaman store publik (viewer)
     */
    public function showPublic($id)
    {
        $store = Store::findOrFail($id);
        $products = $store->products()->latest()->get();

        return view('seller.store-public', compact('store', 'products'));
    }

    /**
     * FORM register store (seller)
     */
    public function register()
    {
        return view('seller.store.register');
    }

    /**
     * SIMPAN data registration store
     */
    public function storeRegister(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'logo'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'about'       => 'required|string',
            'phone'       => 'required|string|max:20',
            'city'        => 'required|string|max:100',
            'address'     => 'required|string',
            'postal_code' => 'required|string|max:10',
        ]);

        $logo = $request->hasFile('logo')
            ? $request->file('logo')->store('stores', 'public')
            : null;

        Store::create([
            'user_id'     => Auth::id(),
            'name'        => $request->name,
            'logo'        => $logo,
            'about'       => $request->about,
            'phone'       => $request->phone,
            'city'        => $request->city,
            'address'     => $request->address,
            'postal_code' => $request->postal_code,
        ]);

        // Ubah role user → seller
        $user = \App\Models\User::findOrFail(Auth::id());
        $user->update(['role' => 'seller']);

        return redirect()
            ->route('seller.dashboard')
            ->with('success', 'Store registered successfully!');
    }

}