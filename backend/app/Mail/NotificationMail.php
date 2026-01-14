<?php
namespace App\Mail;

use App\Models\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;
    protected $notification;

    /**
     * Create a new message instance.
     */
    public function __construct(Notification $notification, array $data)
    {
        $this->notification = $notification;
        $this->data         = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->notification->title ?? 'Notification',
            from: env('MAIL_FROM_ADDRESS', 'system'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.notification',
            with: [
                'notification' => $this->notification,
                'data'         => $this->data,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

// NotificationService
//      │
//      ▼
// RabbitMQ Producer → email queue
//      │
//      ▼
// RabbitMQ Consumer (Email Worker)
//      │
//      ▼
// NotificationMail
//      │
//      ▼
// Laravel Mail → SMTP Provider
