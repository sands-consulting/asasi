<?php

namespace App;

use App\Libraries\Traits\DateAccessorTrait;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    use DateAccessorTrait;

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

    public function scopeLastLogin($query)
    {
        return $query->with('user')
            ->select(\DB::raw('MAX(created_at) as created_at, action, user_id'))
            ->where('action', 'login')
            ->groupBy('user_id')
            ->orderBy('created_at');
    }

    public static function boot()
    {
        parent::boot();
    }
}
