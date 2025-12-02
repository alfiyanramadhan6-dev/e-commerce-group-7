<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;
use Illuminate\Support\Str;

class ProductCategorySeeder extends Seeder
{
    public function run()
    {
        // PARENT CATEGORY
        $dessert = ProductCategory::create([
            'parent_id' => null,
            'image' => 'dessert.png',
            'name' => 'Dessert',
            'slug' => 'dessert',
            'tagline' => 'Manis dan lezat',
            'description' => 'Makanan pencuci mulut'
        ]);

        // CHILD CATEGORY
        ProductCategory::insert([
            [
                'parent_id' => $dessert->id,
                'image' => 'donut.png',
                'name' => 'Donat',
                'slug' => 'donat',
                'tagline' => 'Manis dan empuk',
                'description' => 'Donat aneka topping'
            ],
            [
                'parent_id' => $dessert->id,
                'image' => 'coklat.png',
                'name' => 'Coklat',
                'slug' => 'coklat',
                'tagline' => 'Leleh di mulut',
                'description' => 'Coklat premium'
            ],
            [
                'parent_id' => $dessert->id,
                'image' => 'eskrim.png',
                'name' => 'Es Krim',
                'slug' => 'es-krim',
                'tagline' => 'Segar dan creamy',
                'description' => 'Es krim berbagai rasa'
            ],
        ]);

        // CATEGORY LAIN TANPA PARENT
        ProductCategory::insert([
            [
                'parent_id' => null,
                'image' => null,
                'name' => 'Cake',
                'slug' => 'cake',
                'tagline' => 'Kategori Cake',
                'description' => 'Aneka cake'
            ],
            [
                'parent_id' => null,
                'image' => null,
                'name' => 'Dessert Box',
                'slug' => 'dessert-box',
                'tagline' => 'Kategori Dessert Box',
                'description' => 'Dessert dalam box'
            ],
            [
                'parent_id' => null,
                'image' => null,
                'name' => 'Pudding',
                'slug' => 'pudding',
                'tagline' => 'Kategori Pudding',
                'description' => 'Pudding manis'
            ],
            [
                'parent_id' => null,
                'image' => null,
                'name' => 'Ice Cream',
                'slug' => 'ice-cream',
                'tagline' => 'Kategori Ice Cream',
                'description' => 'Es krim'
            ],
            [
                'parent_id' => null,
                'image' => null,
                'name' => 'Pastry',
                'slug' => 'pastry',
                'tagline' => 'Kategori Pastry',
                'description' => 'Pastry & bakery'
            ],
        ]);
    }
}
