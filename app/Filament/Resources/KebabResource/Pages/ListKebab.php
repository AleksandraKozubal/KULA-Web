<?php

declare(strict_types=1);

namespace Blumilk\Website\Filament\Resources\NewsResource\Pages;

use App\Filament\Resources\BaseResource\Pages\BaseListRecord;
use App\Filament\Resources\KebabResource;

class ListKebab extends BaseListRecord
{
    protected static string $resource = KebabResource::class;
}
