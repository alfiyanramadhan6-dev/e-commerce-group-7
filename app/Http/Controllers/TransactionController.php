<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use App\Models\Buyer;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Menampilkan riwayat transaksi user
     */
    public function index()
    {
        $buyer = auth()->user()->buyer;

        if (!$buyer) {
            $buyer = Buyer::create(['user_id' => auth()->id()]);
        }

        $transactions = Transaction::with('details.product')
            ->where('buyer_id', $buyer->id)
            ->latest()
            ->get();

        return view('user.transactions.index', compact('transactions'));
    }

    /**
     * Menampilkan detail transaksi
     */
    public function show($id)
    {
        $buyer = auth()->user()->buyer;

        if (!$buyer) {
            $buyer = Buyer::create(['user_id' => auth()->id()]);
        }

        $transaction = Transaction::with(['details.product', 'store'])
            ->where('buyer_id', $buyer->id)
            ->findOrFail($id);

        return view('user.transactions.show', compact('transaction'));
    }

    /**
     * Seller melihat semua order untuk tokonya
     */
    public function sellerOrders()
    {
        $store = auth()->user()->store;

        $orders = Transaction::with(['details.product', 'buyer.user'])
            ->where('store_id', $store->id)
            ->latest()
            ->get();

        return view('seller.orders.index', compact('orders'));
    }

    /**
     * Seller mengupdate status pengiriman
     */
    public function shipOrder(Request $request, $id)
    {
        $request->validate([
            'tracking_number' => 'required',
        ]);

        $store = auth()->user()->store;

        $transaction = Transaction::where('store_id', $store->id)->findOrFail($id);

        $transaction->shipping = 'shipped';
        $transaction->tracking_number = $request->tracking_number;
        $transaction->save();

        return back()->with('success', 'Status pengiriman berhasil diperbarui!');
    }
}