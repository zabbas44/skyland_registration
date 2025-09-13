<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        // Client & Company section
        'name',
        'full_name',
        'company_name',
        'mobile',
        'office_phone',
        'email',
        'website',
        'client_type',
        'trade_license_number',
        'address',
        
        // Required legacy fields for database compatibility
        'primary_contact_person',
        'official_email',
        'contact_mobile',
        'physical_address',
        'services_required',
        'selection_reason',
        'preferred_payment_method',
        
        // Project & Service Requirements section
        'project_type',
        'service_needed',
        'estimated_budget',
        
        // Address section
        'street',
        'community',
        'emirate',
        'plot_unit_number',
        
        // Timeline section
        'target_start_date',
        'desired_timeline',
        'project_brief',
        
        // File paths
        'site_plans_path',
        'additional_documents_path',
        
        // Legacy fields (for backward compatibility)
        'full_name',
        'org_name',
        'industry',
        'job_title',
        'nationality',
        'email',
        'mobile',
        'office_phone',
        'address',
        'website',
        'nature_of_business',
        'core_services',
        'budget_range',
        'referral_source',
        'trade_license_number',
        'tax_id',
        'primary_contact_person',
        'designation',
        'official_email',
        'contact_mobile',
        'contact_landline',
        'physical_address',
        'contact_website',
        'business_license_path',
        'tax_certificate_path',
        'company_profile_path',
        'id_copy_path',
        'services_required',
        'expected_order_volume',
        'business_budget_range',
        'business_referral_source',
        'selection_reason',
        'preferred_payment_method',
        'bank_name',
        'bank_branch',
        'bank_account_number',
        'iban',
        'swift_code',
        'created_source',
        'status',
        'status_reason',
        'status_updated_at',
        'status_updated_by',
    ];

    protected $casts = [
        'core_services' => 'array',
        'services_required' => 'array',
        'status_updated_at' => 'datetime',
    ];

    /**
     * Get all communication logs for the client.
     */
    public function communicationLogs()
    {
        return CommunicationLog::where('entity_type', 'client')
                               ->where('entity_id', $this->id);
    }

    /**
     * Scope for searching clients by email.
     */
    public function scopeByEmail($query, $email)
    {
        return $query->where('email', $email)
                     ->orWhere('official_email', $email);
    }

    /**
     * Scope for filtering by client type.
     */
    public function scopeByClientType($query, $type)
    {
        return $query->where('client_type', $type);
    }

    /**
     * Check if organization name is required based on client type.
     */
    public function isOrgNameRequired(): bool
    {
        return in_array($this->client_type, ['Corporate', 'Government', 'NGOs']);
    }

    /**
     * Check if job title is required based on client type.
     */
    public function isJobTitleRequired(): bool
    {
        return $this->client_type === 'Corporate';
    }

    /**
     * Check if trade license is required based on client type.
     */
    public function isTradeLicenseRequired(): bool
    {
        return in_array($this->client_type, ['Corporate', 'Government', 'NGOs']);
    }

    /**
     * Get the user who updated the status.
     */
    public function statusUpdatedBy()
    {
        return $this->belongsTo(User::class, 'status_updated_by');
    }

    /**
     * Check if client is approved.
     */
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    /**
     * Check if client is rejected.
     */
    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    /**
     * Check if client is pending.
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
