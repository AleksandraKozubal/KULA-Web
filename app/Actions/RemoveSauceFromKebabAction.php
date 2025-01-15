<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\KebabPlace;

class RemoveSauceFromKebabAction
{
    public function execute(int $sauceId): void
    {
        KebabPlace::query()->whereJsonContains("sauces", $sauceId)->get()
            ->each(function (KebabPlace $kebabPlace) use ($sauceId): void {
                $kebabPlace->sauces = array_values(array_diff($kebabPlace->sauces, [$sauceId]));
                $kebabPlace->save();
            });
    }
}
