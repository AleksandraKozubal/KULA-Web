<?php

declare(strict_types=1);

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\BaseResource\Pages\BaseCreateRecord;
use App\Filament\Resources\UserResource;

class CreateUser extends BaseCreateRecord
{
    protected static string $resource = UserResource::class;
}
