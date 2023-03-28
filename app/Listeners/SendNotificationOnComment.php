<?php

namespace App\Listeners;

use App\Events\CommentAdded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendNotificationOnComment implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CommentAdded $event)
    {
        $comment = $event->comment;
        $post = $event->post;
        $message = "New comment added to post #$post->id by $comment->user_name.";
        Log::info($message);
    }
}
