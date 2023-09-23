<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Membership extends Model
{
    use HasFactory;

    protected $casts = [
        'valid_from' => 'datetime',
        'valid_to' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * Current membership scope
     *
     * @param $query
     * @return mixed
     */
    public function scopeCurrent($query)
    {
        return $query
            ->where('valid_from', '<=', Carbon::now())
            ->orderBy('updated_at', 'desc')
            ->limit(1);
    }

    /*
     * Active memberships scope
     */
    public function scopeActive($query)
    {
        return $query
            ->where('valid_from', '<=', Carbon::now());
    }
}
