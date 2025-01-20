<?php

declare(strict_types=1);

namespace App\Filament\Resources\KebabPlaceResource\Pages;

use App\Events\KebabPlaceCreated;
use App\Filament\Resources\BaseResource\Pages\BaseCreateRecord;
use App\Filament\Resources\KebabPlaceResource;

class CreateKebabPlace extends BaseCreateRecord
{
    protected static string $resource = KebabPlaceResource::class;

    protected function afterCreate(): void
    {
        broadcast(new KebabPlaceCreated($this->record));
    }
}
