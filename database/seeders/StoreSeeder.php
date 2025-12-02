<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store;
use App\Models\User;

class StoreSeeder extends Seeder
{
    public function run()
    {
        echo "\n[StoreSeeder] Run executed\n";

        $user = User::first();

        if (!$user) {
            echo "[StoreSeeder] USER NOT FOUND\n";
            return;
        }

        echo "[StoreSeeder] User found ID: {$user->id}\n";

        Store::create([
            'user_id' => $user->id,
            'name' => 'Toko Dessert Manis',
            'logo' => 'logo-dessert.png',
            'about' => 'Toko khusus dessert & makanan manis',
            'phone' => '08111111111',
            'address_id' => 'DSS-001',
            'city' => 'Malang',
            'address' => 'Jl. Manis No. 1',
            'postal_code' => '65100',
            'is_verified' => true,
        ]);

        echo "[StoreSeeder] Store inserted\n";
    }
}
