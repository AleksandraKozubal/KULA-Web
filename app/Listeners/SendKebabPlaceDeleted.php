<?php

namespace App\Listeners;

use App\Events\KebabPlaceDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendKebabPlaceDeleted implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(KebabPlaceDeleted $event): void
    {
        $kebabPlace = $event->kebabPlace;

        Log::info('KebabPlaceDeleted event handled', ['kebabPlace' => $kebabPlace]);
    }
}
