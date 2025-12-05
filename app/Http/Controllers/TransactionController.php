<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // MEMBER - see own transactions
    public function index()
    {
        $buyerId = auth()->id();

        $transactions = Transaction::with(['transactionDetails.product'])
            ->where('buyer_id', $buyerId)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($transactions);
    }


    // MEMBER - detail transaction
    public function show($id)
    {
        $buyerId = auth()->id();

        $transaction = Transaction::with(['transactionDetails.product'])
            ->where('buyer_id', $buyerId)
            ->findOrFail($id);

        return response()->json($transaction);
    }


    // SELLER - list orders for seller's store
    public function sellerOrders()
    {
        $storeId = auth()->user()->store->id;

        $orders = Transaction::with(['buyer', 'transactionDetails.product'])
            ->where('store_id', $storeId)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($orders);
    }


    // SELLER - mark order as shipped
    public function shipOrder(Request $request, $id)
    {
        $request->validate([
            'tracking_number' => 'required|string|max:255'
        ]);

        $storeId = auth()->user()->store->id;

        $transaction = Transaction::where('store_id', $storeId)->findOrFail($id);

        $transaction->update([
            'tracking_number' => $request->tracking_number,
            'payment_status'  => 'shipped'
        ]);

        return response()->json([
            'message' => 'Order shipped successfully',
            'data'    => $transaction
        ]);
    }
}
