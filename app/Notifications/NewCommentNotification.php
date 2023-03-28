<?php

namespace App\Notifications;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCommentNotification extends Notification
{
    use Queueable;

    public $comment;
    public $post;
    public $img_url;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Comment $comment, Post $post, $img_url)
    {
        $this->comment = $comment;
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
    public function toArray($notifiable)
    {
        return [
            'comment_id' => $this->comment->id,
            'comment_text' => $this->comment->body,
            'user_name' => $this->comment->user->name,
            'post_id' => $this->post->id,
            'post_title' => $this->post->title,
            'img_url' => $this->img_url,
            'post_url' => url('/posts/' . $this->post->id),
        ];
    }
}
