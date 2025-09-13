<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Vendor;

class VendorStatusUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public $vendor;
    public $status;
    public $reason;

    /**
     * Create a new message instance.
     */
    public function __construct(Vendor $vendor, string $status, ?string $reason = null)
    {
        $this->vendor = $vendor;
        $this->status = $status;
        $this->reason = $reason;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = match($this->status) {
            'approved' => 'Congratulations! Your Supplier Registration Has Been Approved',
            'rejected' => 'Update on Your Supplier Registration Application',
            default => 'Supplier Registration Status Update'
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
            view: 'emails.vendor-status-update',
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
