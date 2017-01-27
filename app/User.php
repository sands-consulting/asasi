<?php

namespace App;

use App\Traits\Roleable;
use App\Traits\DateAccessor;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Venturecraft\Revisionable\RevisionableTrait;

class User extends Authenticatable
{
    use Notifiable, RevisionableTrait, Roleable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'confirmation_token', 'password', 'remember_token',
    ];

    protected $searchable = [
        'name', 'email'
    ];

    protected $sortable = [
        'name', 'email', 'status'
    ];

    /*
     * Relationship
     */
    
    public function latestLog()
    {
        return $this->hasOne(UserHistory::class, 'user_id')->latest();
    }

    public function histories()
    {
        return $this->morphMany(UserHistories::class, 'actionable');
    }

    public function bookmarks()
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }

    public function blacklists()
    {
        return $this->hasMany(UserBlacklist::class);
    }

    public function notices()
    {
        return $this->belongsToMany(Notice::class, 'notice_evaluator', 'user_id', 'notice_id')
            ->withPivot(['type_id', 'status'])
            ->withTimestamps();
    }

    public function organizations()
    {
        return $this->belongsToMany(Organization::class);
    }

    public function submissions()
    {
        return $this->belongsToMany(User::class, 'submission_evaluator', 'user_id', 'submission_id')
            ->withPivot(['status'])
            ->withTimestamps();
    }
    
    public function subscriptions()
    {
        return $this->vendor->first()->subscriptions;
    }

    public function vendor()
    {
        return $this->belongsToMany(Vendor::class)
            ->withPivot(['status'])
            ->wherePivot('status', 'active');
    }

    public function vendors()
    {
        return $this->belongsToMany(Vendor::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /*
     * Custom Attributes
     */

    public function getActiveAttribute()
    {
        return $this->status == 'active';
    }

    public function getBlacklistedAttribute()
    {
        return $this->blacklists()->active()->count() > 0;
    }

    public function getVendorAttribute()
    {
        return $this->hasRole('Vendor') ? $this->vendors()->first() : null;
    }

    /*
     * Search scopes
     */

    public function scopeSearch($query, $queries = [])
    {
        if (isset($queries['keywords']) && !empty($queries['keywords'])) {
            $keywords = $queries['keywords'];
            $query->where(function ($query) use ($keywords) {
                foreach ($this->searchable as $column) {
                    $query->orWhere("{$this->getTable()}.{$column}", 'LIKE', "%$keywords%");
                }
            });
            $query->orWhereHas('vendors', function ($query) use ($keywords) {
                $query->where('name', 'LIKE', "%$keywords%");
            });
            unset($queries['keywords']);
        }

        if (isset($queries['role']) && !empty($queries['role'])) {
            $role   = $queries['role'];
            $query->whereHas('roles', function ($roles) use ($role) {
                $roles->whereId($role);
            });
            unset($queries['role']);
        }

        foreach ($queries as $key => $value) {
            if (empty($value)) {
                continue;
            }
            $query->where("{$this->getTable()}.{$key}", $value);
        }
    }

    public function scopeSort($query, $column, $direction)
    {
        if (in_array($column, $this->sortable) && in_array($direction, ['asc', 'desc'])) {
            $query->orderBy($column, $direction);
        }
    }

    /*
     * Scopes
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeEvaluators($query)
    {
        $query->whereHas('roles', function ($roles) {
            return $roles->whereName('evaluator');
        });
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    public function scopeSuspended($query)
    {
        return $query->where('status', 'suspended');
    }

    /**
     * State controls
     */
    public function canActivate()
    {
        return $this->status != 'active';
    }

    public function canSuspend()
    {
        return Auth::user()->id != $this->id && $this->status != 'suspended';
    }

    /*
     * Helpers
     */
    public function hasSubscription()
    {
        $vendor = $this->vendor;
        if ($vendor) {
            return $vendor->active_subscription;
        }

        return false;
    }

    public function hasBoughtNotice($notice_id)
    {
        return $this->vendor->notices()->find($notice_id);
    }
    
    public static function options()
    {
        return static::lists('name', 'id')->toArray();
    }
    
    public function newNotification()
    {
        $notification = new Notification;
        $notification->user()->associate($this);
     
        return $notification;
    }


    /**
     * Boot
     */

    public static function boot()
    {
        parent::boot();

        parent::creating(function ($user) {
            $user->confirmation_token = str_random(64);
        });
    }
}
