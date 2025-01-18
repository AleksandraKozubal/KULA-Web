<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\KebabPlaceCreated;
use App\Listeners\SendKebabPlaceNotification;

class EventServiceProvider extends ServiceProvider
{
    /** @var array<class-string, array<int, class-string>> */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        KebabPlaceCreated::class => [
            SendKebabPlaceNotification::class,
        ],
    ];

    public function boot(): void
    {
        parent::boot();
    }

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
