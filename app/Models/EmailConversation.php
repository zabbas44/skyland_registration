<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmailConversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'vendor_id',
        'subject',
        'admin_message',
        'client_reply',
        'admin_sent_at',
        'client_replied_at',
        'admin_read',
        'client_read',
        'status',
        'admin_attachments',
        'client_attachments'
    ];

    protected $casts = [
        'admin_sent_at' => 'datetime',
        'client_replied_at' => 'datetime',
        'admin_read' => 'boolean',
        'client_read' => 'boolean',
        'admin_attachments' => 'array',
        'client_attachments' => 'array'
    ];

    /**
     * Get the client that owns the conversation
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the vendor that owns the conversation
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * Get the entity (client or vendor) for this conversation
     */
    public function getEntity()
    {
        return $this->client_id ? $this->client : $this->vendor;
    }

    /**
     * Get entity type
     */
    public function getEntityType()
    {
        return $this->client_id ? 'client' : 'vendor';
    }

    /**
     * Get display name for the entity
     */
    public function getEntityName()
    {
        $entity = $this->getEntity();
        if (!$entity) {
            return 'Unknown';
        }
        
        if ($this->client_id) {
            // Client entity
            return $entity->full_name ?? 'Unknown Client';
        } else {
            // Vendor entity  
            return ($entity->first_name . ' ' . $entity->last_name) ?? 'Unknown Vendor';
        }
    }

    /**
     * Get entity email
     */
    public function getEntityEmail()
    {
        $entity = $this->getEntity();
        if (!$entity) {
            return null;
        }
        
        if ($this->client_id) {
            // Client entity
            return $entity->email ?? null;
        } else {
            // Vendor entity
            return $entity->contact_email ?? null;
        }
    }

    /**
     * Check if conversation has client reply
     */
    public function hasReply()
    {
        return !empty($this->client_reply);
    }

    /**
     * Mark as read by admin
     */
    public function markAsReadByAdmin()
    {
        $this->update(['admin_read' => true]);
    }

    /**
     * Mark as read by client
     */
    public function markAsReadByClient()
    {
        $this->update(['client_read' => true]);
    }

    /**
     * Get formatted attachments for admin
     */
    public function getFormattedAdminAttachments()
    {
        if (!$this->admin_attachments) {
            return [];
        }

        return collect($this->admin_attachments)->map(function ($attachment) {
            return [
                'name' => $attachment['original_name'] ?? 'Unknown',
                'path' => $attachment['path'] ?? '',
                'size' => $attachment['size'] ?? 0,
                'type' => $attachment['type'] ?? 'unknown'
            ];
        })->toArray();
    }

    /**
     * Get formatted attachments for client
     */
    public function getFormattedClientAttachments()
    {
        if (!$this->client_attachments) {
            return [];
        }

        return collect($this->client_attachments)->map(function ($attachment) {
            return [
                'name' => $attachment['original_name'] ?? 'Unknown',
                'path' => $attachment['path'] ?? '',
                'size' => $attachment['size'] ?? 0,
                'type' => $attachment['type'] ?? 'unknown'
            ];
        })->toArray();
    }

    /**
     * Scope for unread by admin
     */
    public function scopeUnreadByAdmin($query)
    {
        return $query->where('admin_read', false);
    }

    /**
     * Scope for unread by client
     */
    public function scopeUnreadByClient($query)
    {
        return $query->where('client_read', false);
    }

    /**
     * Scope for pending reply
     */
    public function scopePendingReply($query)
    {
        return $query->where('status', 'pending_reply');
    }
}