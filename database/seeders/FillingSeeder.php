<?php

namespace Database\Seeders;

use App\Models\Filling;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FillingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Filling::create(['name' => 'Wołowina', 'is_vegan' => false, 'hex_color' => '#FFC107']);
        Filling::create(['name' => 'Kuciak', 'is_vegan' => false, 'hex_color' => '#8B4513']);
        Filling::create(['name' => 'Baranina', 'is_vegan' => false, 'hex_color' => '#800000']);
        Filling::create(['name' => 'Falafel', 'is_vegan' => true, 'hex_color' => '#D2691E']);
    }
}
