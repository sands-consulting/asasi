<?php

namespace App;

use App\Traits\DateAccessor;

class UserHistory extends Model
{
    use DateAccessorTrait;

    protected $fillable = [
        'action', 'actionable_id', 'actionable_type', 'remarks', 'ip_address', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')
            ->withTrashed();
    }

    public function actionable()
    {
        return $this->morphTo();
    }

    public function scopeLastLogin($query, $limit = null)
    {
        $logins = $query->with('user')
            ->select(\DB::raw('MAX(created_at) as created_at, action, user_id'))
            ->where('action', 'login')
            ->groupBy('user_id')
            ->orderBy('created_at');

            if (!is_null($limit)) 
                $logins->limit($limit);
            
        return $logins;
    }

    public static function boot()
    {
        parent::boot();
    }
}
