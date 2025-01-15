<?php

declare(strict_types=1);

namespace App\Filament\Resources\FillingResource\Pages;

use App\Filament\Resources\FillingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFilling extends CreateRecord
{
    protected static string $resource = FillingResource::class;
}
