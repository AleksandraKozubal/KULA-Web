<?php

declare(strict_types=1);

namespace App\Filament\Resources\FillingResource\Pages;

use App\Filament\Resources\FillingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFilling extends EditRecord
{
    protected static string $resource = FillingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
