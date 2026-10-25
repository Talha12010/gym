<?php

namespace App\Models;
use App\Models\Feedback;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable implements MustVerifyEmail      ,   CanResetPassword         
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
    public function feedback() {
        return $this->hasMany(Feedback::class, 'user_id');
    }
    public function classes(): HasMany
    {
        return $this->hasMany(ClassModel::class, 'T_id');
    }

    public function scopeTrainers($query)
    {
        return $query->where('role', 'trainer');
    }

    public function payments()
{
    return $this->hasMany(Payment::class, 'member_id');
}
}
