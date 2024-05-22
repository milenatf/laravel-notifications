<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class PostComment extends Notification implements ShouldQueue
{
    use Queueable;

    private $comment;

    /**
     * Create a new notification instance.
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject("Novo comentário de {$this->comment->title}")
                    ->line($this->comment->body)
                    ->action('VEja o comentário', route('posts.show', $this->comment->post_id))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $data = [
            'comment_id' => $this->comment->id,
            'comment_body' => $this->comment->body,
            'post_id' => $this->comment->post_id,
            'commenter_id' => $this->comment->user_id,
        ];

        // Log::info('Dados da notificação', $data);

        return $data;

    }

    public function toDatabase(object $notifiable)
    {
        return [
            'comment' => $this->comment
        ];
    }
}
