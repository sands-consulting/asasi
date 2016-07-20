<?php

namespace App;

class UserLog extends Model
{
    protected $fillable = [
        'action',
        'ip_adddress',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
