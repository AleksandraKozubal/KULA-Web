<?php

declare(strict_types=1);

namespace App\Filament\Resources\KebabPlaceResource\Widgets;

use App\Models\KebabPlace;
use Filament\Widgets\ChartWidget;

class KebabPlaceStats extends ChartWidget
{
    protected static ?string $heading = "Statusy kebabów";

    protected function getData(): array
    {
        $kebabPlaces = KebabPlace::query()->get();

        $open = $kebabPlaces->where("status", "otwarte")->count();
        $planned = $kebabPlaces->where("status", "planowane")->count();
        $closed = $kebabPlaces->where("status", "zamknięte")->count();

        return [
            "labels" => ["Otwarte", "Planowane", "Zamknięte"],
            "datasets" => [
                [
                    "label" => "Kebab places",
                    "data" => [$open, $planned, $closed],
                    "backgroundColor" => ["#4CAF50", "#2196F3", "#F44336"],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return "doughnut";
    }
}
