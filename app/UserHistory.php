<?php

namespace App;

use App\Traits\DateAccessor;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserHistory
 * @package App
 */
class UserHistory extends Model
{
    use DateAccessor;

    /**
     * @var array
     */
    protected $fillable = [
        'action', 'actionable_id', 'actionable_type', 'remarks', 'ip_address', 'user_id'
    ];

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')
            ->withTrashed();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function actionable()
    {
        return $this->morphTo();
    }

    /**
     * @param $query
     * @param null $limit
     * @return mixed
     */
    public function scopeLastLogin($query, $limit = null)
    {
        $logins = $query->with('user')
            ->select(\DB::raw('MAX(created_at) as created_at, action, user_id'))
            ->where('action', 'login')
            ->groupBy('user_id', 'action')
            ->orderBy('created_at');

            if (!is_null($limit)) 
                $logins->limit($limit);
            
        return $logins;
    }

    /**
     *
     */
    public static function boot()
    {
        parent::boot();
    }
}
