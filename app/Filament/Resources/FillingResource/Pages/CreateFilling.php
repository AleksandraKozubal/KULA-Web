<?php

declare(strict_types=1);

namespace App\Filament\Resources\FillingResource\Pages;

use App\Filament\Resources\BaseResource\Pages\BaseCreateRecord;
use App\Filament\Resources\FillingResource;

class CreateFilling extends BaseCreateRecord
{
    protected static string $resource = FillingResource::class;
}
