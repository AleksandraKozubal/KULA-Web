<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum KebabPlaceSortByCriteria: string implements HasLabel
{
    case id = "id";
    case rating = "google_maps_rating";
    case name = "name";

    public function getLabel(): ?string
    {
        return match ($this) {
            self::id => "ID",
            self::rating => "Ocena",
            self::name => "Nazwa",
        };
    }
}
