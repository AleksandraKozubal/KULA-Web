<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class KebabPlaceCreated
{
    use Dispatchable, SerializesModels;

    public $kebabPlace;

    public function __construct($kebabPlace)
    {
        $this->kebabPlace = $kebabPlace;
    }
}
