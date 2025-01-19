<?php

declare(strict_types=1);

namespace App\Filament\Resources\KebabPlaceResource\Pages;

use App\Filament\Resources\BaseResource\Pages\BaseListRecord;
use App\Filament\Resources\KebabPlaceResource;

class ListKebabPlace extends BaseListRecord
{
    protected static string $resource = KebabPlaceResource::class;
}
