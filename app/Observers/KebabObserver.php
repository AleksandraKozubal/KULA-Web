<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\KebabPlace;

class KebabObserver
{
    public function creating(KebabPlace $kebab): void
    {
        $kebab->sauces = $this->prepareSauces($kebab->sauces);
        $kebab->fillings = $this->prepareFillings($kebab->fillings);
    }

    public function updating(KebabPlace $kebab): void
    {
        $kebab->sauces = $this->prepareSauces($kebab->sauces);
        $kebab->fillings = $this->prepareFillings($kebab->fillings);
    }

    private function prepareSauces(array $sauces): array
    {
        return array_map(
            fn(string $sauce): int => (int)$sauce,
            $sauces,
        );
    }

    private function prepareFillings(array $fillings): array
    {
        return array_map(
            fn(string $filling): int => (int)$filling,
            $fillings,
        );
    }
}
