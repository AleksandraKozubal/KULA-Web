<?php

declare(strict_types=1);

namespace App\Observers;


use App\Models\Kebab;

class KebabObserver
{
    public function creating(Kebab $kebab): void
    {
        $kebab->sauces = $this->prepareSauces($kebab->sauces);
    }

    public function updating(Kebab $kebab): void
    {
        $kebab->sauces = $this->prepareSauces($kebab->sauces);
    }

    private function prepareSauces(array $sauces): array
    {
        return array_map(
            fn(string $sauce): int => (int)$sauce,
            $sauces,
        );
    }
}