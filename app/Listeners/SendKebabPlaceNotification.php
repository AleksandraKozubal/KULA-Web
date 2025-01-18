<?php

namespace App\Listeners;

use App\Events\KebabPlaceCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendKebabPlaceNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(KebabPlaceCreated $event)
    {
        $kebabPlace = $event->kebabPlace;

        \Log::info('KebabPlaceCreated event handled', ['kebabPlace' => $kebabPlace]);
    }
}
