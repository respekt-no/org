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

    protected $appends = [
        'has_active_membership',
        'member_since',
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
        'member_since' => 'datetime',
    ];


    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    public function getHasActiveMembershipAttribute()
    {
        return (bool) $this->memberships()->current()->get()->first();
    }

    public function getMemberSinceAttribute()
    {
        return $this->memberships()->current()->get()->first()->valid_from ?? null;
    }
}
