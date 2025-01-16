<?php

namespace App\Listeners;

use App\Events\KebabPlaceCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendKebabPlaceCreatedNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(KebabPlaceCreated $event)
    {
        broadcast($event);
    }
}
