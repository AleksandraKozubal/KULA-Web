<?php

declare(strict_types=1);

namespace App\Filament\Resources\FillingResource\Pages;

use App\Filament\Resources\SauceResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFilling extends CreateRecord
{
    protected static string $resource = SauceResource::class;
}
