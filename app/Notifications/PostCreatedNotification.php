<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostCreatedNotification extends Notification
{
    use Queueable;

    public $post;
    public $img_url;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Post $post, $img_url)
    {
        $this->post = $post;
        $this->img_url = $img_url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'post_id' => $this->post->id,
            'post_title' => $this->post->title,
            'user_name' => $this->post->user->name,
            'img_url' => $this->img_url,
        ];
    }
}
