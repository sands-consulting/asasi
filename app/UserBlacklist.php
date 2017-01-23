<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

class UserBlacklist extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'reason', 'user_id', 'expired_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
