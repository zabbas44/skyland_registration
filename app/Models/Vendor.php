<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        // Contact section
        'first_name',
        'last_name',
        'contact_company_name',
        'contact_mobile',
        'contact_email',
        'contact_designation',
        
        // Company Information section
        'company_contact_person',
        'company_designation',
        'company_email',
        'company_phone',
        'company_name',
        'trade_license_number',
        'business_type',
        'nature_of_business',
        'year_of_establishment',
        'website',
        'address',
        'tax_id',
        
        // File paths
        'business_license_path',
        'tax_certificate_path',
        'company_profile_path',
        
        // Compliance & Financial section
        'preferred_payment_method',
        'bank_name',
        'bank_branch',
        'bank_account_number',
        'iban',
        'swift_code',
        
        // Attachments
        'trade_license_path',
        'vat_certificate_path',
        'company_profile_path',
        
        // Other fields
        'accepted_payment_terms',
        'worked_with_us_before',
        'has_legal_dispute',
        'created_source',
        'status',
        'status_reason',
        'status_updated_at',
        'status_updated_by',
    ];

    protected $casts = [
        'worked_with_us_before' => 'boolean',
        'has_legal_dispute' => 'boolean',
        'year_of_establishment' => 'integer',
        'status_updated_at' => 'datetime',
    ];

    /**
     * Get all communication logs for the vendor.
     */
    public function communicationLogs()
    {
        return CommunicationLog::where('entity_type', 'vendor')
                               ->where('entity_id', $this->id);
    }

    /**
     * Get the vendor's full contact name.
     */
    public function getFullContactNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Scope for searching vendors by email.
     */
    public function scopeByEmail($query, $email)
    {
        return $query->where('contact_email', $email)
                     ->orWhere('company_email', $email);
    }

    /**
     * Scope for filtering by business type.
     */
    public function scopeByBusinessType($query, $type)
    {
        return $query->where('business_type', $type);
    }

    /**
     * Get the user who updated the status.
     */
    public function statusUpdatedBy()
    {
        return $this->belongsTo(User::class, 'status_updated_by');
    }

    /**
     * Check if vendor is approved.
     */
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    /**
     * Check if vendor is rejected.
     */
    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    /**
     * Check if vendor is pending.
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Get status display name.
     */
    public function getStatusDisplayAttribute(): string
    {
        return match($this->status) {
            'pending' => 'Under Review',
            'approved' => 'Approved',
            'rejected' => 'Rejected',
            default => 'Unknown'
        };
    }

    /**
     * Get status color class for UI.
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending' => 'yellow',
            'approved' => 'green',
            'rejected' => 'red',
            default => 'gray'
        };
    }
}
