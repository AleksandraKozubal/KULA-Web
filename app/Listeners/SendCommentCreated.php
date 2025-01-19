<?php

namespace App\Listeners;

use App\Events\CommentCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendCommentCreated implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(CommentCreated $event): void
    {
        $kebabPlace = $event->kebabPlace;
        $comment = $event->comment;

        Log::info('CommentCreated event handled', ['kebabPlace' => $kebabPlace, 'comment' => $comment]);
    }
}
