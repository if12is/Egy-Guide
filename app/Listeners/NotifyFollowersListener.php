<?php

namespace App\Listeners;

use App\Events\NewPostEvent;
use App\Notifications\PostCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class NotifyFollowersListener implements ShouldQueue
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
     * @param  \App\Events\NewPostEvent  $event
     * @return void
     */
    public function handle(NewPostEvent $event)
    {
        $post = $event->post;
        $user = $post->user;
        $followers = $user->followers;
        $img_url = Auth::user()->getFirstMedia('avatars')->getUrl();
        // Send notifications to the followers of the user who created the post
        foreach ($followers as $follower) {
            $follower->notify(new PostCreatedNotification($post, $img_url));
        }
    }
}
