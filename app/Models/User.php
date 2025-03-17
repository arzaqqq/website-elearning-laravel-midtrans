<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Panel;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;


    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole('admin');
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'photo',
        'occupation',
        'email',
        'password',
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

    public function transaction ()
    {
        return $this->hasMany(Transaction::class, 'user_id');
    }

    public function getActiveSubscription()
    {
        return $this->transactions()
        ->where('is_paid', true)
        ->where('ended_at', '>=', now())
        ->first();
    }

    public function  hasActiveSubscription()
    {
        return $this->transaction()
         ->where('is_paid', true)
         ->where('ended_at', '>=', now())
         ->exists();
    }
}
