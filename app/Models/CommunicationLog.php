<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommunicationLog extends Model
{
    protected $fillable = [
        'entity_type',
        'entity_id',
        'admin_user_id',
        'subject',
        'message_preview',
        'status',
        'provider_message_id',
        'sent_at',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    /**
     * Get the entity (client or vendor) that the log belongs to.
     */
    public function entity()
    {
        if ($this->entity_type === 'client') {
            return $this->belongsTo(Client::class, 'entity_id');
        } elseif ($this->entity_type === 'vendor') {
            return $this->belongsTo(Vendor::class, 'entity_id');
        }
        
        return null;
    }

    /**
     * Get the admin user who sent the communication.
     */
    public function adminUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_user_id');
    }

    /**
     * Scope for filtering by entity type.
     */
    public function scopeForEntityType($query, $type)
    {
        return $query->where('entity_type', $type);
    }

    /**
     * Scope for filtering by status.
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope for filtering by admin user.
     */
    public function scopeByAdminUser($query, $userId)
    {
        return $query->where('admin_user_id', $userId);
    }

    /**
     * Scope for recent logs.
     */
    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }
}
