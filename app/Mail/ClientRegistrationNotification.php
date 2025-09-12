<?php

namespace App\Mail;

use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class ClientRegistrationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $client;

    /**
     * Create a new message instance.
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Client Registration - ' . $this->client->full_name,
            from: 'info@skylandconstruction.com',
            replyTo: ['info@skylandconstruction.com'],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.client-registration-notification',
            with: [
                'client' => $this->client,
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
        $attachments = [];
        
        // Add client documents if they exist
        if ($this->client->site_plans_path && file_exists(storage_path('app/' . $this->client->site_plans_path))) {
            $attachments[] = Attachment::fromStorage($this->client->site_plans_path)
                ->as('Site_Plans_' . $this->client->full_name . '.pdf')
                ->withMime('application/pdf');
        }
        
        if ($this->client->additional_documents_path && file_exists(storage_path('app/' . $this->client->additional_documents_path))) {
            $attachments[] = Attachment::fromStorage($this->client->additional_documents_path)
                ->as('Additional_Documents_' . $this->client->full_name . '.pdf')
                ->withMime('application/pdf');
        }
        
        if ($this->client->business_license_path && file_exists(storage_path('app/' . $this->client->business_license_path))) {
            $attachments[] = Attachment::fromStorage($this->client->business_license_path)
                ->as('Business_License_' . $this->client->full_name . '.pdf')
                ->withMime('application/pdf');
        }
        
        if ($this->client->tax_certificate_path && file_exists(storage_path('app/' . $this->client->tax_certificate_path))) {
            $attachments[] = Attachment::fromStorage($this->client->tax_certificate_path)
                ->as('Tax_Certificate_' . $this->client->full_name . '.pdf')
                ->withMime('application/pdf');
        }
        
        if ($this->client->company_profile_path && file_exists(storage_path('app/' . $this->client->company_profile_path))) {
            $attachments[] = Attachment::fromStorage($this->client->company_profile_path)
                ->as('Company_Profile_' . $this->client->full_name . '.pdf')
                ->withMime('application/pdf');
        }
        
        if ($this->client->id_copy_path && file_exists(storage_path('app/' . $this->client->id_copy_path))) {
            $attachments[] = Attachment::fromStorage($this->client->id_copy_path)
                ->as('ID_Copy_' . $this->client->full_name . '.pdf')
                ->withMime('application/pdf');
        }
        
        return $attachments;
    }
}
