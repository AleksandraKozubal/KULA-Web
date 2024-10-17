<?php

declare(strict_types=1);

namespace App\Filament\Resources\KebabResource\Pages;

use App\Filament\Resources\BaseResource\Pages\BaseEditRecord;
use App\Filament\Resources\KebabResource;
use Filament\Actions;

class EditKebab extends BaseEditRecord
{
    protected static string $resource = KebabResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
