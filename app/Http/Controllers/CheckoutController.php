<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Buyer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Menampilkan isi cart
     */
    public function showCart()
    {
        $cart = session()->get('cart', []);

        // Ambil data produk berdasarkan product_id
        $products = Product::whereIn('id', array_keys($cart))->get();

        return view('user.cart.index', compact('products', 'cart'));
    }

    /**
     * Menampilkan halaman checkout
     */
    public function showCheckout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect('/cart')->with('error', 'Keranjang masih kosong.');
        }

        $products = Product::whereIn('id', array_keys($cart))->get();

        return view('user.checkout.index', compact('products', 'cart'));
    }

    /**
     * Proses checkout → Membuat transaksi + detail
     */
    public function processCheckout(Request $request)
    {
        $request->validate([
            'address'      => 'required',
            'city'         => 'required',
            'postal_code'  => 'required',
            'shipping_type'=> 'required',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect('/cart')->with('error', 'Keranjang kosong.');
        }

        DB::beginTransaction();

        try {
            $buyer = auth()->user()->buyer;

            // Fix: jika buyer belum ada → buat otomatis
            if (!$buyer) {
                $buyer = \App\Models\Buyer::create([
                    'user_id' => auth()->id(),
                ]);
            }

            // ambil semua produk yang ada di keranjang
            $products = Product::whereIn('id', array_keys($cart))->get();

            $grand_total = 0;
            $storeId = null;

            // hitung total keseluruhan
            foreach ($products as $p) {
                $qty = $cart[$p->id]['qty'];

                // VALIDASI STOK
                if ($p->stock < $qty) {
                    return redirect('/cart')->with('error', "Stok {$p->name} tidak cukup.");
                }

                $subtotal = $p->price * $qty;
                $grand_total += $subtotal;
                $storeId = $p->store_id;
            }

            // cost
            $shipping_cost = 20000; // flat (bisa diubah)
            $tax = $grand_total * 0.1;
            $final_total = $grand_total + $shipping_cost + $tax;

            // buat transaksi
            $transaction = Transaction::create([
                'code'          => 'TRX-' . Str::upper(Str::random(8)),
                'buyer_id'      => $buyer->id,
                'store_id'      => $storeId,
                'address'       => $request->address,
                'city'          => $request->city,
                'postal_code'   => $request->postal_code,
                'shipping_type' => $request->shipping_type,
                'shipping_cost' => $shipping_cost,
                'tax'           => $tax,
                'grand_total'   => $final_total,
                'payment_status'=> 'paid',
            ]);

            // masukkan item ke transaction_details
            foreach ($products as $p) {
                $qty = $cart[$p->id]['qty'];
                $subtotal = $qty * $p->price;

                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id'     => $p->id,
                    'qty'            => $qty,
                    'subtotal'       => $subtotal,
                ]);

                // kurangi stok
                $p->stock -= $qty;
                $p->save();
            }

            // HAPUS CART
            session()->forget('cart');

            DB::commit();

            return redirect()->route('transactions.show', $transaction->id)
                ->with('success', 'Checkout berhasil!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}