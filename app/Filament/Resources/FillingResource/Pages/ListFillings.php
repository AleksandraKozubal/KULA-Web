<?php

declare(strict_types=1);

namespace App\Filament\Resources\FillingResource\Pages;

use App\Filament\Resources\FillingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFillings extends ListRecords
{
    protected static string $resource = FillingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
