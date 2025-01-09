<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Kebab;

class RemoveFillingFromKebabAction
{
    public function execute(int $fillingId): void
    {
        Kebab::query()->whereJsonContains("fillings", $fillingId)->get()
            ->each(function (Kebab $kebab) use ($fillingId): void {
                $kebab->fillings = array_values(array_diff($kebab->fillings, [$fillingId]));
                $kebab->save();
            });
    }
}
