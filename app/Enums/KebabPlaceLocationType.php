<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum KebabPlaceLocationType: string implements HasLabel
{
    case DineIn = "lokal";
    case FoodStand = "buda";

    public function getLabel(): ?string
    {
        return match ($this) {
            self::DineIn => "Lokal",
            self::FoodStand => "Buda",
        };
    }
}
