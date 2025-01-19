<?php

namespace App\Listeners;

use App\Events\KebabPlaceUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendKebabPlaceUpdated implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(KebabPlaceUpdated $event): void
    {
        $kebabPlace = $event->kebabPlace;

        Log::info('KebabPlaceUpdated event handled', ['kebabPlace' => $kebabPlace]);
    }
}
