<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use App\Models\KebabPlace;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class KebabPlaceCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public KebabPlace $kebabPlace;

    public function __construct(KebabPlace $kebabPlace)
    {
        $this->kebabPlace = $kebabPlace;
    }

    public function broadcastOn(): array
    {
        return new Channel('kebab-places');
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->kebabPlace->id,
            'name' => $this->kebabPlace->name,
            'location' => [
                'latitude' => $this->kebabPlace->latitude,
                'longitude' => $this->kebabPlace->longitude,
            ],
        ];
    }
}
