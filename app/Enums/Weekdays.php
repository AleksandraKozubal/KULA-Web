<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Weekdays: string implements HasLabel
{
    case Monday = "Mon";
    case Tuesday = "Tue";
    case Wednesday = "Wed";
    case Thursday = "Thu";
    case Friday = "Fri";
    case Saturday = "Sat";
    case Sunday = "Sun";

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
