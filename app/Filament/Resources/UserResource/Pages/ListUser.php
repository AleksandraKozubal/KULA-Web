<?php

declare(strict_types=1);

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\BaseResource\Pages\BaseListRecord;
use App\Filament\Resources\UserResource;
use Filament\Actions;

class ListUser extends BaseListRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
