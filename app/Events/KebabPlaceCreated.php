<?php

namespace App\Events;

use App\Models\KebabPlace;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class KebabPlaceCreated
{
    public Model $kebabPlace;

    use Dispatchable, InteractsWithSockets, SerializesModels;


    public function __construct(Model $kebabPlace)
    {
        $this->kebabPlace = $kebabPlace;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('kebab-place'),
        ];
    }
}
