<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use App\Models\Post;

class Commented extends Notification
{
    /**
     * Post property.
     *
     * @var \App\User\Post
     */
    protected $post;

    /**
     * Create a new notification instance.
     *
     * @param \App\Models\Post
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
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
            'title' => $this->post->title,
            'slug' => $this->post->slug,
        ];
    }
}
