<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewPostNotification extends Notification
{
    use Queueable;
    private $post_id;
    private $created_by;
    private $img_url;
    private $post_title;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($post_id, $img_url, $post_title, $created_by)
    {
        $this->post_id = $post_id;
        $this->created_by = $created_by;
        $this->img_url = $img_url;
        $this->post_title = $post_title;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // $post = $this->post;
        // return (new MailMessage)
        //     ->line('A new post has been created.')
        //     ->action('View Post', url('/posts/' . $post->id))
        //     ->line('Thank you for using our application!');
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
            'post_id' => $this->post_id,
            'created_by' => $this->created_by,
            'img_url' => $this->img_url,
            'post_title' => $this->post_title,
        ];
    }
}
