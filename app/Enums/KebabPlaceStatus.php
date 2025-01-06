<?php

declare(strict_types=1);

namespace App\Enums;

enum KebabPlaceStatus: string
{
    case open = "otwarte";
    case closed = "zamknięte";
    case planned = "planowane";
}