<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum SuggestionStatus: string implements HasLabel
{
    case Accepted = "zaakceptowane";
    case Rejected = "odrzucone";
    case Pending = "oczekujące";

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Accepted => "zaakceptowane",
            self::Rejected => "odrzucone",
            self::Pending => "oczekujące",
        };
    }
}
