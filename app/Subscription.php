<?php namespace App;

use App\Traits\DateAccessor;
use App\Traits\Searchable;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Venturecraft\Revisionable\RevisionableTrait;

class Subscription extends Authenticatable
{
    use RevisionableTrait,
        Searchable,
        SoftDeletes,
        DateAccessor;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'number',
        'start_at',
        'end_at',
        'package_id',
        'user_id',
        'subscriber_type',
        'subscriber_id',
        'status'
    ];

    protected $attributes = [
        'status' => 'pending'
    ];

    protected $searchable = [
        'number',
    ];

    protected $sortable = [
        'started_at',
        'expired_at',
        'status'
    ];

    protected $dates = [
        'start_at',
        'end_at'
    ];

    /*
     * Scopes
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /*
     * Relationship
     */
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function subscriber()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getExpiringAttribute()
    {
        $compare = $this->expired_at->subMonths(3);
        return $compare->freshTimestamp()->gte($compare);
    }

    public function getExpiredAttribute()
    {
        return $compare->freshTimestamp()->gt($this->expired_at);
    }

}
