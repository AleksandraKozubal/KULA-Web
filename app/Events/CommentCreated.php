<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Log;

class CommentCreated implements ShouldBroadcast
{
    public Model $kebabPlace;
    public Model $comment;

    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(Model $kebabPlace, Model $comment )
    {
        $this->kebabPlace = $kebabPlace;
        $this->comment = $comment;

        Log::info('CommentCreated event dispatched', ['kebabPlace' => $kebabPlace, 'comment' => $comment]);
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
        return 'CommentCreated';
    }
}
