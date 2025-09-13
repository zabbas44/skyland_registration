<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'user_type',
        'client_id',
        'supplier_id',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    /**
     * Get the client associated with this user.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the supplier associated with this user.
     */
    public function supplier()
    {
        return $this->belongsTo(Vendor::class, 'supplier_id');
    }

    /**
     * Check if user is admin.
     */
    public function isAdmin(): bool
    {
        return $this->user_type === 'admin' || $this->is_admin;
    }

    /**
     * Check if user is client.
     */
    public function isClient(): bool
    {
        return $this->user_type === 'client';
    }

    /**
     * Check if user is supplier.
     */
    public function isSupplier(): bool
    {
        return $this->user_type === 'supplier';
    }

    /**
     * Get the related entity (client or supplier).
     */
    public function getRelatedEntity()
    {
        if ($this->isClient()) {
            return $this->client;
        }
        
        if ($this->isSupplier()) {
            return $this->supplier;
        }
        
        return null;
    }
}
