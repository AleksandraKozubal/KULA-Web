<?php

namespace Database\Seeders;

use App\Models\Sauce;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SauceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sauce::create([
            'name' => 'Garlic Sauce',
            'spiciness' => 'Mild',
            'is_vegan' => true,
            'is_gluten_free' => true,
            'hex_color' => '#F5F5DC'
        ]);

        Sauce::create([
            'name' => 'Hot Chili Sauce',
            'spiciness' => 'Spicy',
            'is_vegan' => true,
            'is_gluten_free' => true,
            'hex_color' => '#FF4500'
        ]);

        Sauce::create([
            'name' => 'Yogurt Sauce',
            'spiciness' => 'Mild',
            'is_vegan' => false,
            'is_gluten_free' => true,
            'hex_color' => '#FFFFFF'
        ]);

        Sauce::create([
            'name' => 'Tahini Sauce',
            'spiciness' => 'Medium',
            'is_vegan' => true,
            'is_gluten_free' => true,
            'hex_color' => '#D2B48C'
        ]);

        Sauce::create([
            'name' => 'Barbecue Sauce',
            'spiciness' => 'Medium',
            'is_vegan' => false,
            'is_gluten_free' => true,
            'hex_color' => '#8B0000'
        ]);
    }
}
