<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\ChatConversation;
use App\Models\ChatMessage;

class ChatMessageNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $conversation;
    public $message;

    /**
     * Create a new message instance.
     */
    public function __construct(ChatConversation $conversation, ChatMessage $message)
    {
        $this->conversation = $conversation;
        $this->message = $message;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $sender = $this->message->sender;
        $senderName = $sender->isAdmin() ? 'SKYLAND Admin' : $sender->name;
        
        return new Envelope(
            subject: "New message from {$senderName}",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.chat-message-notification',
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
