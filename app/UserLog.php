<?php

namespace App;

class UserLog extends Model
{
    protected $fillable = [
        'action',
<<<<<<< e36b68adacc8101ed6edb7239c6991e135e232ec
        'remarks',
=======
>>>>>>> Fix user log.
        'ip_address',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
