<?php

namespace App\Mail;

use App\Models\EmailConversation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailConversationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public EmailConversation $conversation;
    public string $notificationType;

    /**
     * Create a new message instance.
     */
    public function __construct(EmailConversation $conversation, string $notificationType)
    {
        $this->conversation = $conversation;
        $this->notificationType = $notificationType;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = match($this->notificationType) {
            'new_message' => 'New Message: ' . $this->conversation->subject,
            'reply_received' => 'Reply Received: ' . $this->conversation->subject,
            default => 'Email Conversation Update'
        };

        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.email-conversation-notification',
            with: [
                'conversation' => $this->conversation,
                'notificationType' => $this->notificationType
            ]
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