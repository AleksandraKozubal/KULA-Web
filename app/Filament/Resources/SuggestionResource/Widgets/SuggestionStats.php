<?php

declare(strict_types=1);

namespace App\Filament\Resources\SuggestionResource\Widgets;

use App\Enums\SuggestionStatus;
use App\Models\Suggestion;
use Filament\Widgets\ChartWidget;

class SuggestionStats extends ChartWidget
{
    protected static ?string $heading = "Statusy sugestii użytkowników";
    protected static ?string $maxHeight = "300px";

    protected function getData(): array
    {
        $suggestions = Suggestion::query()->get();

        $accepted = $suggestions->where("status", SuggestionStatus::Accepted)->count();
        $rejected = $suggestions->where("status", SuggestionStatus::Rejected)->count();
        $pending = $suggestions->where("status", SuggestionStatus::Pending)->count();

        return [
            "labels" => ["Zaakceptowane", "Odrzucone", "Oczekujące"],
            "datasets" => [
                [
                    "label" => "Suggestions",
                    "data" => [$accepted, $rejected, $pending],
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
