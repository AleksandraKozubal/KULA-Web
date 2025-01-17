<?php

declare(strict_types=1);

namespace App\Enums;

enum KebabPlaceSortByCriteria: string
{
    case Id = "id";
    case Rating = "google_maps_rating";
    case Name = "name";
}
