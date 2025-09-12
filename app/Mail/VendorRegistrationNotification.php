<?php

namespace App\Mail;

use App\Models\Vendor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class VendorRegistrationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $vendor;

    /**
     * Create a new message instance.
     */
    public function __construct(Vendor $vendor)
    {
        $this->vendor = $vendor;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Vendor Registration - ' . $this->vendor->first_name . ' ' . $this->vendor->last_name,
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
            view: 'emails.vendor-registration-notification',
            with: [
                'vendor' => $this->vendor,
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
        
        // Add vendor documents if they exist
        if ($this->vendor->business_license_path && file_exists(storage_path('app/' . $this->vendor->business_license_path))) {
            $attachments[] = Attachment::fromStorage($this->vendor->business_license_path)
                ->as('Business_License_' . $this->vendor->company_name . '.pdf')
                ->withMime('application/pdf');
        }
        
        if ($this->vendor->tax_certificate_path && file_exists(storage_path('app/' . $this->vendor->tax_certificate_path))) {
            $attachments[] = Attachment::fromStorage($this->vendor->tax_certificate_path)
                ->as('Tax_Certificate_' . $this->vendor->company_name . '.pdf')
                ->withMime('application/pdf');
        }
        
        if ($this->vendor->company_profile_path && file_exists(storage_path('app/' . $this->vendor->company_profile_path))) {
            $attachments[] = Attachment::fromStorage($this->vendor->company_profile_path)
                ->as('Company_Profile_' . $this->vendor->company_name . '.pdf')
                ->withMime('application/pdf');
        }
        
        if ($this->vendor->trade_license_path && file_exists(storage_path('app/' . $this->vendor->trade_license_path))) {
            $attachments[] = Attachment::fromStorage($this->vendor->trade_license_path)
                ->as('Trade_License_' . $this->vendor->company_name . '.pdf')
                ->withMime('application/pdf');
        }
        
        if ($this->vendor->vat_certificate_path && file_exists(storage_path('app/' . $this->vendor->vat_certificate_path))) {
            $attachments[] = Attachment::fromStorage($this->vendor->vat_certificate_path)
                ->as('VAT_Certificate_' . $this->vendor->company_name . '.pdf')
                ->withMime('application/pdf');
        }
        
        return $attachments;
    }
}
