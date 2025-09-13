<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChatMessage extends Model
{
    protected $fillable = [
        'conversation_id',
        'sender_id',
        'message',
        'message_type',
        'is_edited',
        'edited_at',
        'read_at',
        'metadata',
    ];

    protected $casts = [
        'is_edited' => 'boolean',
        'edited_at' => 'datetime',
        'read_at' => 'datetime',
        'metadata' => 'array',
    ];

    /**
     * Get the conversation this message belongs to.
     */
    public function conversation(): BelongsTo
    {
        return $this->belongsTo(ChatConversation::class, 'conversation_id');
    }

    /**
     * Get the user who sent this message.
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Get attachments for this message.
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(ChatAttachment::class, 'message_id');
    }

    /**
     * Check if message has attachments.
     */
    public function hasAttachments(): bool
    {
        return $this->attachments()->exists();
    }

    /**
     * Get attachment count.
     */
    public function getAttachmentCountAttribute(): int
    {
        return $this->attachments()->count();
    }

    /**
     * Check if message is from admin.
     */
    public function isFromAdmin(): bool
    {
        return $this->sender && $this->sender->isAdmin();
    }

    /**
     * Check if message is read.
     */
    public function isRead(): bool
    {
        return !is_null($this->read_at);
    }

    /**
     * Mark message as read.
     */
    public function markAsRead()
    {
        if (!$this->isRead()) {
            $this->update(['read_at' => now()]);
        }
    }

    /**
     * Get formatted message content.
     */
    public function getFormattedMessageAttribute(): string
    {
        if ($this->message_type === 'system') {
            return $this->message;
        }

        // Convert emojis and format text
        return nl2br(e($this->message));
    }

    /**
     * Get message preview for notifications.
     */
    public function getPreview(int $length = 100): string
    {
        if ($this->message_type === 'file') {
            $attachmentCount = $this->attachment_count;
            return $attachmentCount > 1 ? "📎 {$attachmentCount} files" : "📎 File attachment";
        }

        if ($this->message_type === 'system') {
            return $this->message;
        }

        return \Str::limit(strip_tags($this->message), $length);
    }

    /**
     * Scope for unread messages.
     */
    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }

    /**
     * Scope for messages in a date range.
     */
    public function scopeInDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    /**
     * Scope for messages by type.
     */
    public function scopeByType($query, $type)
    {
        return $query->where('message_type', $type);
    }
}
