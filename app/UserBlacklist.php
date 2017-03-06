<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserBlacklist extends Model
{
    use SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'reason', 'user_id', 'expired_at'
    ];

    protected $attributes = [
        'status' => 'inactive',
    ];

    public function histories()
    {
        return $this->morphMany(UserHistory::class, 'actionable');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active')->where('expired_at', '>', (new Carbon));
    }
}
