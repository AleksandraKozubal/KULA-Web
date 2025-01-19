<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Weekdays: string implements HasLabel
{
    case Monday = "monday";
    case Tuesday = "tuesday";
    case Wednesday = "wednesday";
    case Thursday = "thursday";
    case Friday = "friday";
    case Saturday = "saturday";
    case Sunday = "sunday";

    public function getLabel(): string
    {
        return match ($this) {
            self::Monday => "Poniedziałek",
            self::Tuesday => "Wtorek",
            self::Wednesday => "Środa",
            self::Thursday => "Czwartek",
            self::Friday => "Piątek",
            self::Saturday => "Sobota",
            self::Sunday => "Niedziela",
        };
    }
}
