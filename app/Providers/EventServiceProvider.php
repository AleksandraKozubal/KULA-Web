<?php

declare(strict_types=1);

namespace App\Providers;

use App\Listeners\SendCommentCreated;
use App\Listeners\SendKebabPlaceDeleted;
use App\Listeners\SendKebabPlaceRatingChanged;
use App\Listeners\SendKebabPlaceUpdated;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\KebabPlaceCreated;
use App\Listeners\SendKebabPlaceCreated;

class EventServiceProvider extends ServiceProvider
{
    /** @var array<class-string, array<int, class-string>> */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        KebabPlaceCreated::class => [
            SendKebabPlaceCreated::class,
            SendKebabPlaceUpdated::class,
            SendKebabPlaceDeleted::class,
            SendKebabPlaceRatingChanged::class,
            SendCommentCreated::class,
        ],
    ];

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
