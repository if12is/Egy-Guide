<?php

namespace App\Events;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommentAdded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $comment;
    public $post;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */

    public function __construct(Comment $comment, Post $post)
    {
        $this->comment = $comment;
        $this->post = $post;
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}