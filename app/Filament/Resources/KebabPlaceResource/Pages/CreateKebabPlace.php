<?php

declare(strict_types=1);

namespace App\Filament\Resources\KebabResource\Pages;

use App\Filament\Resources\KebabPlaceResource;
use Filament\Resources\Pages\CreateRecord;

class CreateKebabPlace extends CreateRecord
{
    protected static string $resource = KebabPlaceResource::class;
}
