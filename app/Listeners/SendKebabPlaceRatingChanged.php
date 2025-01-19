<?php

namespace App\Listeners;

use App\Events\KebabPlaceRatingChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendKebabPlaceRatingChanged implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(KebabPlaceRatingChanged $event): void
    {
        $kebabPlace = $event->kebabPlace;

        Log::info('KebabPlaceRatingChanged event handled', ['kebabPlace' => $kebabPlace]);
    }
}
