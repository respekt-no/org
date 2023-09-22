<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are guarded.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthdate' => 'date',
        'address' => 'array',
        'other_addresses' => 'array',
        'password' => 'hashed',
    ];

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    /**
     * Get the user's currently active membership, if any
     *
     * @param $query
     * @return mixed
     */
    public function scopeCurrent($query)
    {
        return $query
            ->where('valid_from', '<=', Carbon::now())
            ->where('valid_to', '>=', Carbon::now())
            ->orderBy('updated_at', 'desc')
            ->limit(1);
    }

    /*
     * Get the user's active memberships
     */
    public function scopeActive($query)
    {
        return $query
            ->where('valid_from', '<=', Carbon::now())
            ->where('valid_to', '>=', Carbon::now());
    }
}
