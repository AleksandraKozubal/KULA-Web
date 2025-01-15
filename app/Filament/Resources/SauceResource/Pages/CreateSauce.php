<?php

declare(strict_types=1);

namespace App\Filament\Resources\SauceResource\Pages;

use App\Filament\Resources\SauceResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSauce extends CreateRecord
{
    protected static string $resource = SauceResource::class;
}
