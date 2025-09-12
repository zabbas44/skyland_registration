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
    ];

    protected $casts = [
        'worked_with_us_before' => 'boolean',
        'has_legal_dispute' => 'boolean',
        'year_of_establishment' => 'integer',
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
}
