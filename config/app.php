<?php

declare(strict_types=1);

use App\Providers\AppServiceProvider;
use App\Providers\AuthServiceProvider;
use App\Providers\EventServiceProvider;
use App\Providers\Filament\AdminPanelProvider;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [
    "name" => env("APP_NAME", "Laravel"),

    "env" => env("APP_ENV", "production"),

    "debug" => (bool)env("APP_DEBUG", false),

    "url" => env("APP_URL", "http://localhost"),

    "asset_url" => env("ASSET_URL"),

    "timezone" => "Europe/Warsaw",

    "locale" => "pl",

    "fallback_locale" => "en",

    "faker_locale" => "pl",

    "key" => env("APP_KEY"),

    "cipher" => "AES-256-CBC",

    "maintenance" => [
        "driver" => "file",
        // 'store' => 'redis',
    ],

    "providers" => ServiceProvider::defaultProviders()->merge([
        AppServiceProvider::class,
        AuthServiceProvider::class,
        App\Providers\BroadcastServiceProvider::class,
        EventServiceProvider::class,
        AdminPanelProvider::class,
        RouteServiceProvider::class,
    ])->toArray(),

    "aliases" => Facade::defaultAliases()->merge([])->toArray(),
];
