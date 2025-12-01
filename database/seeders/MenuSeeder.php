<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $menus = [
            [
                'name' => 'Nasi Gudeg',
                'category' => 'makanan',
                'price' => 15000,
                'is_active' => 1,
                'description' => 'Nasi gudeg khas Yogyakarta dengan bumbu tradisional yang kaya rasa',
                'image' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?w=300&h=200&fit=crop&crop=center',
            ],
            [
                'name' => 'Soto Ayam',
                'category' => 'makanan',
                'price' => 18000,
                'is_active' => 1,
                'description' => 'Soto ayam dengan bumbu tradisional, dilengkapi telur dan kentang',
                'image' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=300&h=200&fit=crop&crop=center',
            ],
            [
                'name' => 'Es Teh Manis',
                'category' => 'minuman',
                'price' => 5000,
                'is_active' => 1,
                'description' => 'Es teh manis segar untuk menemani makan',
                'image' => 'https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=300&h=200&fit=crop&crop=center',
            ],
            [
                'name' => 'Kopi Tubruk',
                'category' => 'minuman',
                'price' => 8000,
                'is_active' => 1,
                'description' => 'Kopi tubruk tradisional dengan cita rasa khas',
                'image' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=300&h=200&fit=crop&crop=center',
            ],
            [
                'name' => 'Pisang Goreng',
                'category' => 'snack',
                'price' => 10000,
                'is_active' => 1,
                'description' => 'Pisang goreng crispy dengan tepung bumbu',
                'image' => 'https://images.unsplash.com/photo-1587735243615-c03f25aaff15?w=300&h=200&fit=crop&crop=center',
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }

     // Kalau sudah ada data, jangan seed lagi
    // if (\App\Models\Menu::count() > 0) {
    //     return;
    // }

    // $menus = [
    //     // data dummy...
    // ];

    // foreach ($menus as $menu) {
    //     \App\Models\Menu::create($menu);
    // }
}
