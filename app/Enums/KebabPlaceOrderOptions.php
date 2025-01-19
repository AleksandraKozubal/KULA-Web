<?php

declare(strict_types=1);

namespace App\Enums;

enum KebabPlaceOrderOptions: string
{
    case Phone = "przez telefon";
    case Website = "własna strona";
    case App = "własna aplikacja";
    case Pyszne = "pyszne.pl";
    case Glovo = "glovo";
}
