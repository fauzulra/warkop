<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Addon;

class AddonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $addons = [
            // Makanan
            ['name' => 'Tambah Telur', 'price' => 5000, 'category' => 'makanan'],
            ['name' => 'Tambah Nasi',  'price' => 5000, 'category' => 'makanan'],
            ['name' => 'Tambah Sosis',  'price' => 5000, 'category' => 'makanan'],
            ['name' => 'Tambah Bakso',  'price' => 5000, 'category' => 'makanan'],

            // Minuman
            ['name' => 'Extra Es Batu', 'price' => 1000, 'category' => 'minuman'],
            ['name' => 'Susu Kental Manis', 'price' => 3000, 'category' => 'minuman'],
            ['name' => 'Topping Coklat', 'price' => 4000, 'category' => 'minuman'],
            ['name' => 'Cup Besar', 'price' => 5000, 'category' => 'minuman'],

            // Snack
            ['name' => 'Tambah Saus', 'price' => 1000, 'category' => 'snack'],
            ['name' => 'Tambah Mayo', 'price' => 2000, 'category' => 'snack'],
        ];

        foreach ($addons as $addon) {
            Addon::create($addon);
        }
    }
}
