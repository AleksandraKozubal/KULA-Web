<?php

declare(strict_types=1);

namespace App\Enums;

enum KebabPlaceSortByCriteria: string
{
    case Id = "id";
    case Rating = "google_maps_rating";
    case Name = "name";
    case YearOfOpening = "opened_at_year";
    case YearOfClosing = "closed_at_year";
}
