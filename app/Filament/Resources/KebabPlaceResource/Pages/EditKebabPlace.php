<?php

declare(strict_types=1);

namespace App\Filament\Resources\KebabResource\Pages;

use App\Filament\Resources\BaseResource\Pages\BaseEditRecord;
use App\Filament\Resources\KebabPlaceResource;
use Filament\Actions;

class EditKebabPlace extends BaseEditRecord
{
    protected static string $resource = KebabPlaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
