<?php

declare(strict_types=1);

namespace App\Filament\Resources\SuggestionResource\Widgets;

use Filament\Widgets\ChartWidget;

class SuggestionStats extends ChartWidget
{
    protected static ?string $heading = "Statusy sugetii użytkowników";
    protected static ?string $maxHeight = "300px";

    protected function getData(): array
    {
        return [
            "labels" => ["Accepted", "Rejected", "Pending"],
            "datasets" => [
                [
                    "label" => "Suggestions",
                    "data" => [1, 2, 3],
                    "backgroundColor" => ["#4CAF50", "#2196F3", "#F44336"],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return "pie";
    }

    protected function getOptions(): array
    {
        return [
            "plugins" => [
                "legend" => [
                    "display" => true,
                ],
            ],
            "scales" => [
                "x" => [
                    "display" => false,
                ],
                "y" => [
                    "display" => false,
                ],
            ],
        ];
    }
}
