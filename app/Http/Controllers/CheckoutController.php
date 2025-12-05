<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $request->validate([
            'store_id'           => 'required|exists:stores,id',
            'address'            => 'required|string|max:255',
            'city'               => 'required|string|max:100',
            'postal_code'        => 'required|string|max:20',
            'shipping_type'      => 'required|string|max:100',
            'shipping_cost'      => 'required|numeric|min:0',
            'products'           => 'required|array|min:1',
            'products.*.id'      => 'required|exists:products,id',
            'products.*.qty'     => 'required|integer|min:1',
        ]);

        return DB::transaction(function () use ($request) {

            $buyerId = auth()->id();
            $code = 'TRX-' . strtoupper(Str::random(10));

            $total = 0;

            foreach ($request->products as $item) {
                $product = Product::lockForUpdate()->find($item['id']);

                if ($product->stock < $item['qty']) {
                    return response()->json([
                        'message' => "Stock for {$product->name} is not enough."
                    ], 400);
                }

                $total += $product->price * $item['qty'];
            }

            $tax = $total * 0.10; // 10% pajak contoh
            $grandTotal = $total + $tax + $request->shipping_cost;

            $transaction = Transaction::create([
                'code'           => $code,
                'buyer_id'       => $buyerId,
                'store_id'       => $request->store_id,
                'address'        => $request->address,
                'city'           => $request->city,
                'postal_code'    => $request->postal_code,
                'shipping_type'  => $request->shipping_type,
                'shipping_cost'  => $request->shipping_cost,
                'tax'            => $tax,
                'grand_total'    => $grandTotal,
                'payment_status' => 'pending'
            ]);

            foreach ($request->products as $item) {

                $product = Product::find($item['id']);

                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id'     => $product->id,
                    'qty'            => $item['qty'],
                    'price'          => $product->price
                ]);

                // Kurangi stok
                $product->stock -= $item['qty'];
                $product->save();
            }

            return response()->json([
                'message'     => 'Checkout successful',
                'transaction' => $transaction->load('transactionDetails')
            ], 201);
        });
    }
}
