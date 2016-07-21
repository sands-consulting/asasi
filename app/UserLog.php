<?php

namespace App;

class UserLog extends Model
{
    protected $fillable = [
        'action',
        'remarks',
        'ip_address',
        'actionable_type',
        'actionable_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function actionable()
    {
        return $this->morphTo();
    }
}
