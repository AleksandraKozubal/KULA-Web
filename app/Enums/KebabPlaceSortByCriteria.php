<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum KebabPlaceSortByCriteria: string
{
    case Id = "id";
    case Rating = "google_maps_rating";
    case Name = "name";
}
