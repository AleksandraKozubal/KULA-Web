<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum KebabPlaceStatus: string implements HasLabel
{
    case Open = "otwarte";
    case Closed = "zamknięte";
    case Planned = "planowane";

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Open => "Otwarte",
            self::Closed => "Zamknięte",
            self::Planned => "Planowane",
        };
    }
}
