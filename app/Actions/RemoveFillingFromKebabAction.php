<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\KebabPlace;

class RemoveFillingFromKebabAction
{
    public function execute(int $fillingId): void
    {
        KebabPlace::query()->whereJsonContains("fillings", $fillingId)->get()
            ->each(function (KebabPlace $kebabPlace) use ($fillingId): void {
                $kebabPlace->fillings = array_values(array_diff($kebabPlace->fillings, [$fillingId]));
                $kebabPlace->save();
            });
    }
}
