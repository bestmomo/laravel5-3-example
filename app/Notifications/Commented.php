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
     * User id property.
     *
     * @var integer
     */
    protected $user_id;

    /**
     * Create a new notification instance.
     *
     * @param Post $post
     * @param integer $user_id
     */
    public function __construct(Post $post, $user_id)
    {
        $this->post = $post;
        $this->user_id = $user_id;
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
            'user_id' => $this->user_id,
        ];
    }
}