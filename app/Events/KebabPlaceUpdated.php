<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Log;

class KebabPlaceUpdated implements ShouldBroadcast
{
    public Model $kebabPlace;

    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(Model $kebabPlace)
    {
        $this->kebabPlace = $kebabPlace;
        Log::info('KebabPlaceUpdated event dispatched', ['kebabPlace' => $kebabPlace]);
    }

    /**
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('kebab-places'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'KebabPlaceUpdated';
    }
}
