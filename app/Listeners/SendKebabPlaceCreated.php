<?php

namespace App\Listeners;

use App\Events\KebabPlaceCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendKebabPlaceCreated implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(KebabPlaceCreated $event): void
    {
        $kebabPlace = $event->kebabPlace;

        Log::info('KebabPlaceCreated event handled', ['kebabPlace' => $kebabPlace]);
    }
}
