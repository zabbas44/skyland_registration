<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatConversation extends Model
{
    protected $fillable = [
        'entity_type',
        'entity_id',
        'title',
        'status',
        'last_message_at',
        'last_message_by',
        'last_message_preview',
        'unread_count_admin',
        'unread_count_client',
    ];

    protected $casts = [
        'last_message_at' => 'datetime',
    ];

    /**
     * Get the client for this conversation.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'entity_id');
    }

    /**
     * Get the vendor for this conversation.
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class, 'entity_id');
    }

    /**
     * Get the entity (client or vendor) for this conversation.
     */
    public function entity()
    {
        if ($this->entity_type === 'client') {
            return $this->client;
        } elseif ($this->entity_type === 'vendor') {
            return $this->vendor;
        }
        
        return null;
    }

    /**
     * Get the user who sent the last message.
     */
    public function lastMessageBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'last_message_by');
    }

    /**
     * Get all messages for this conversation.
     */
    public function messages(): HasMany
    {
        return $this->hasMany(ChatMessage::class, 'conversation_id')->orderBy('created_at');
    }

    /**
     * Get recent messages for this conversation.
     */
    public function recentMessages()
    {
        return $this->messages()->latest()->take(50);
    }

    /**
     * Get unread messages count for a specific user type.
     */
    public function getUnreadCountForUser($userType)
    {
        if ($userType === 'admin') {
            return $this->unread_count_admin;
        } else {
            return $this->unread_count_client;
        }
    }

    /**
     * Mark messages as read for a specific user type.
     */
    public function markAsRead($userType)
    {
        if ($userType === 'admin') {
            $this->update(['unread_count_admin' => 0]);
        } else {
            $this->update(['unread_count_client' => 0]);
        }
    }

    /**
     * Increment unread count for a specific user type.
     */
    public function incrementUnreadCount($userType)
    {
        if ($userType === 'admin') {
            $this->increment('unread_count_admin');
        } else {
            $this->increment('unread_count_client');
        }
    }

    /**
     * Get conversation title.
     */
    public function getDisplayTitle()
    {
        if ($this->title) {
            return $this->title;
        }

        $entity = $this->entity();
        if ($this->entity_type === 'client') {
            return $entity ? $entity->full_name : 'Unknown Client';
        } elseif ($this->entity_type === 'vendor') {
            return $entity ? $entity->company_name : 'Unknown Vendor';
        }

        return 'Conversation';
    }

    /**
     * Check if entity is approved for chat.
     */
    public function isEntityApproved(): bool
    {
        $entity = $this->entity();
        return $entity && $entity->status === 'approved';
    }

    /**
     * Scope for active conversations.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for conversations with unread messages for admin.
     */
    public function scopeWithUnreadForAdmin($query)
    {
        return $query->where('unread_count_admin', '>', 0);
    }

    /**
     * Scope for conversations with unread messages for client.
     */
    public function scopeWithUnreadForClient($query)
    {
        return $query->where('unread_count_client', '>', 0);
    }
}
