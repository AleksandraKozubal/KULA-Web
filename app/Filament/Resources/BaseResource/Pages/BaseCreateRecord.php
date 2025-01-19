<?php

declare(strict_types=1);

namespace App\Filament\Resources\BaseResource\Pages;

use Filament\Resources\Pages\CreateRecord;

class BaseCreateRecord extends CreateRecord
{
    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl("index");
    }
}
