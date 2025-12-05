<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // GET /products
    public function index()
    {
        return response()->json(
            Product::with(['store','productCategory'])->get(),
            200
        );
    }

    // GET /products/{id}
    public function show($id)
    {
        $product = Product::with([
            'store','productCategory','productImages','productReviews'
        ])->findOrFail($id);

        return response()->json($product, 200);
    }


    // ADMIN & SELLER ONLY
    public function store(Request $request)
    {
        $user = Auth::user();

        // Jika bukan admin atau seller → blokir
        if (!in_array($user->role, ['admin', 'seller'])) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Jika seller → gunakan store_id miliknya
        if ($user->role === 'seller') {
            $request->merge([
                'store_id' => $user->store->id
            ]);
        }

        $request->validate([
            'store_id' => 'required|exists:stores,id',
            'product_category_id' => 'required|exists:product_categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'condition' => 'required|in:new,second',
            'price' => 'required|numeric',
            'weight' => 'required|integer',
            'stock' => 'required|integer'
        ]);

        // generate slug unik
        $slug = Str::slug($request->name);
        $counter = 1;
        $originalSlug = $slug;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $product = Product::create([
            'store_id' => $request->store_id,
            'product_category_id' => $request->product_category_id,
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'condition' => $request->condition,
            'price' => $request->price,
            'weight' => $request->weight,
            'stock' => $request->stock
        ]);

        return response()->json([
            'message' => 'Product created successfully',
            'data' => $product
        ], 201);
    }


    // ADMIN & SELLER ONLY
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $product = Product::findOrFail($id);

        // Seller hanya boleh ubah produk milik tokonya
        if ($user->role === 'seller' && $product->store_id !== $user->store->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        // Member tidak boleh update
        if ($user->role === 'member') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'product_category_id' => 'sometimes|exists:product_categories,id',
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'condition' => 'sometimes|in:new,second',
            'price' => 'sometimes|numeric',
            'weight' => 'sometimes|integer',
            'stock' => 'sometimes|integer'
        ]);

        // Jika nama berubah, update slug
        if ($request->has('name')) {
            $slug = Str::slug($request->name);
            $counter = 1;
            $originalSlug = $slug;

            while (Product::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                $slug = $originalSlug . '-' . $counter++;
            }

            $product->slug = $slug;
        }

        $product->update($request->except('name'));
        if ($request->has('name')) {
            $product->name = $request->name;
            $product->save();
        }

        return response()->json([
            'message' => 'Product updated successfully',
            'data' => $product
        ]);
    }


    // ADMIN & SELLER ONLY
    public function destroy($id)
    {
        $user = Auth::user();
        $product = Product::findOrFail($id);

        // Seller hanya boleh delete produk miliknya
        if ($user->role === 'seller' && $product->store_id !== $user->store->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        // Member tidak boleh delete
        if ($user->role === 'member') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
}
