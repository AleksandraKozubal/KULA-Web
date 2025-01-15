<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum KebabPlaceLocationType: string implements HasLabel
{
    case dineIn = "lokal";
    case foodStand = "buda";

    public function getLabel(): ?string
    {
        return match ($this) {
            self::dineIn => "Lokal",
            self::foodStand => "Buda",
        };
    }
}
