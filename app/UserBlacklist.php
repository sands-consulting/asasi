<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class UserBlacklist extends Model
{
    use RevisionableTrait,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'reason',
        'user_id',
        'expired_at'
    ];

    protected $attributes = [
        'status' => 'inactive',
    ];

    public function logs()
    {
        return $this->morphMany(UserLog::class, 'actionable');
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
