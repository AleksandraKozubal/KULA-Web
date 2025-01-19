<?php

declare(strict_types=1);

namespace App\Filament\Resources\SuggestionResource\Pages;

use App\Filament\Resources\BaseResource\Pages\BaseListRecord;
use App\Filament\Resources\SuggestionResource;
use Filament\Actions;

class ListSuggestion extends BaseListRecord
{
    protected static string $resource = SuggestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
