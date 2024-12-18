<?php

namespace Database\Seeders;

use App\Models\KebabPlace;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KebabPlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KebabPlace::create([
            'name' => 'Kebab King',
            'street' => 'Legnicka',
            'building_number' => '12A',
            'latitude' => '51.2087',
            'longitude' => '16.1614',
            'google_maps_url' => 'https://goo.gl/maps/xxxxx',
            'google_maps_rating' => '4.5',
            'phone' => '123-456-789',
            'website' => 'http://kebabking.legnica.pl',
            'email' => 'info@kebabking.legnica.pl',
            'fillings' => '1, 2, 3',
            'sauces' => '1, 2, 4',
            'opening_hours' => 'Poniedziałek - Piątek: 11:00 - 22:00, Sobota: 11:00 - 20:00, Niedziela: 11:00 - 18:00',
            'year_of_establishment' => '2020',
            'number_of_employees' => '30',
            'image' => 'kebab_king_image.jpg'
        ]);

        KebabPlace::create([
            'name' => 'Kebab Paradise',
            'street' => 'Jaworzyńska',
            'building_number' => '45B',
            'latitude' => '51.2044',
            'longitude' => '16.1672',
            'google_maps_url' => 'https://goo.gl/maps/yyyyy',
            'google_maps_rating' => '4.7',
            'phone' => '987-654-321',
            'website' => 'http://kebabparadise.legnica.pl',
            'email' => 'contact@kebabparadise.legnica.pl',
            'fillings' => '1, 3',
            'sauces' => '3, 5',
            'opening_hours' => 'Poniedziałek - Piątek: 11:00 - 22:00, Sobota: 11:00 - 20:00, Niedziela: 11:00 - 18:00',
            'year_of_establishment' => '2018',
            'image' => 'kebab_paradise_image.jpg'
        ]);
    }
}
