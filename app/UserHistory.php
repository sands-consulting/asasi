<?php

namespace App;

class UserHistory extends Model
{
    protected $fillable = [
        'action', 'actionable_id', 'actionable_type', 'remarks', 'ip_address', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
