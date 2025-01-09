<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Kebab;

class RemoveSauceFromKebabAction
{
    public function execute(int $sauceId): void
    {
        Kebab::query()->whereJsonContains("sauces", $sauceId)->get()
            ->each(function (Kebab $kebab) use ($sauceId): void {
                $kebab->sauces = array_values(array_diff($kebab->sauces, [$sauceId]));
                $kebab->save();
            });
    }
}
