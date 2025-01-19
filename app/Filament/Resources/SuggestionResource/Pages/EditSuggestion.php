<?php

declare(strict_types=1);

namespace App\Filament\Resources\SuggestionResource\Pages;

use App\Filament\Resources\BaseResource\Pages\BaseEditRecord;
use App\Filament\Resources\SuggestionResource;
use Filament\Actions;

class EditSuggestion extends BaseEditRecord
{
    protected static string $resource = SuggestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
