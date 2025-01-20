<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Actions\RetrieveOpinionAction;
use App\Models\Filling;
use App\Models\KebabPlace;
use App\Models\Sauce;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Seeder;

class ProductionSeeder extends Seeder
{
    /**
     * @throws GuzzleException
     */
    public function run(): void
    {
        $fillings = json_decode(file_get_contents(public_path("data/fillings_data.json")), true);
        $sauces = json_decode(file_get_contents(public_path("data/sauces_data.json")), true);
        $kebabs = json_decode(file_get_contents(public_path("data/kebab_data.json")), true);

        foreach ($fillings as $filling) {
            Filling::query()->create($filling);
        }

        foreach ($sauces as $sauce) {
            Sauce::query()->create($sauce);
        }

        foreach ($kebabs as $kebab) {
            KebabPlace::query()->create($kebab);
        }

        $action = new RetrieveOpinionAction();
        $action->execute();
    }
}
