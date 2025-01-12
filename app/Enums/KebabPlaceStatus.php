<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum KebabPlaceStatus: string implements HasLabel
{
    case open = "otwarte";
    case closed = "zamknięte";
    case planned = "planowane";

    public function getLabel(): ?string
    {
        return match ($this) {
            self::open => "Otwarte",
            self::closed => "Zamknięte",
            self::planned => "Planowane",
        };
    }
}
