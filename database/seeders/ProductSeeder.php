<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Store;
use App\Models\ProductCategory;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $store = Store::first();
        $category = ProductCategory::first();

        if (!$store || !$category) {
            echo "Store atau Category belum ada\n";
            return;
        }

        Product::create([
            'store_id' => $store->id,
            'product_category_id' => $category->id,
            'name' => 'Chocolate Cake Premium',
            'slug' => Str::slug('Chocolate Cake Premium'),
            'description' => 'Cake coklat lembut dan premium',
            'condition' => 'new',
            'price' => 120000,
            'weight' => 500,
            'stock' => 20,
        ]);

        Product::create([
            'store_id' => $store->id,
            'product_category_id' => $category->id,
            'name' => 'Vanilla Dessert Box',
            'slug' => Str::slug('Vanilla Dessert Box'),
            'description' => 'Dessert box vanilla creamy',
            'condition' => 'new',
            'price' => 45000,
            'weight' => 300,
            'stock' => 15,
        ]);
    }
}
