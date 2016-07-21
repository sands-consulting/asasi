<?php

namespace App;

use Carbon\Carbon;

class UserBlacklist extends Model
{
    protected $fillable = [
        'reason',
        'user_id',
        'expired_at'
    ];

    protected $attributes = [
        'status' => 'inactive',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active')->where('expired_at', '>', (new Carbon));
    }
}
