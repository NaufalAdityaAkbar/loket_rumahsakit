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
        'google_id',
        'avatar',
        'role',
        'assigned_loket_id',
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
        ];
    }

    public function assignedLoket()
    {
        return $this->belongsTo(Loket::class, 'assigned_loket_id');
    }

    public function isPetugas(): bool
    {
        return $this->role === 'petugas';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    public function hasLoketAccess(?int $loketId): bool
    {
        if (!$this->isPetugas()) {
            return false;
        }
        return is_null($this->assigned_loket_id) || $this->assigned_loket_id === $loketId;
    }
}
