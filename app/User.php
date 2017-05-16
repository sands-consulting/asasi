<?php

namespace App;

use App\Traits\Roleable;
use App\Traits\DateAccessor;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Venturecraft\Revisionable\RevisionableTrait;

/**
 * Class User
 * @package App
 */
class User extends Authenticatable
{
    use DateAccessor,
        Notifiable,
        RevisionableTrait,
        Roleable,
        SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'confirmation_token',
        'password',
        'remember_token',
    ];

    /**
     * @var array
     */
    protected $searchable = [
        'name', 'email'
    ];

    /**
     * @var array
     */
    protected $sortable = [
        'name', 'email', 'status'
    ];

    /**
     * @var array
     */
    protected $attributes = [
        'status' => 'inactive'
    ];

    /*
     * Relationship
     */

    /**
     * @return mixed
     */
    public function latestLog()
    {
        return $this->hasOne(UserHistory::class, 'user_id')->latest();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function histories()
    {
        return $this->morphMany(UserHistory::class, 'actionable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blacklists()
    {
        return $this->hasMany(UserBlacklist::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function notices()
    {
        return $this->belongsToMany(Notice::class, 'notice_evaluator', 'user_id', 'notice_id')
            ->withPivot(['type_id', 'status'])
            ->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function organizations()
    {
        return $this->belongsToMany(Organization::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function evalautions()
    {
        return $this->hasMany(NoticeEvlauation::class);
    }

    /**
     * @return mixed
     */
    public function subscriptions()
    {
        return $this->vendor->first()->subscriptions();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function vendors()
    {
        return $this->belongsToMany(Vendor::class);
    }

    /*
     * Custom Attributes
     */

    /**
     * @return bool
     */
    public function getActiveAttribute()
    {
        return $this->status == 'active';
    }

    /**
     * @return bool
     */
    public function getBlacklistedAttribute()
    {
        return $this->blackpluck()->active()->count() > 0;
    }

    /**
     * @return mixed|null
     */
    public function getOrganizationAttribute()
    {
        return $this->hasPermission('has:organization') ? $this->organizations()->first() : null;
    }

    /**
     * @return mixed|null
     */
    public function getVendorAttribute()
    {
        return $this->hasPermission('has:vendor') ? $this->vendors()->first() : null;
    }

    /*
     * Search scopes
     */

    /**
     * @param $query
     * @param array $queries
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

    /**
     * @param $query
     * @param $column
     * @param $direction
     */
    public function scopeSort($query, $column, $direction)
    {
        if (in_array($column, $this->sortable) && in_array($direction, ['asc', 'desc'])) {
            $query->orderBy($column, $direction);
        }
    }

    /*
     * Scopes
     */
    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('users.status', 'active');
    }

    /**
     * @param $query
     */
    public function scopeEvaluators($query)
    {
        $query->whereHas('roles', function ($role) {
            return $role->whereHas('permissions', function($permission) {
                return $permission->whereName('evaluation:index');
            });
        });
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    /**
     * @param $query
     * @return mixed
     */
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

    /**
     * @return bool
     */
    public function canSuspend()
    {
        return $this->status != 'suspended';
    }

    /*
     * Helpers
     */
    /**
     * @return bool
     */
    public function hasSubscription()
    {
        $vendor = $this->vendor;
        if ($vendor) {
            return $vendor->active_subscription;
        }

        return false;
    }

    /**
     * @param $notice_id
     * @return mixed
     */
    public function hasBoughtNotice($notice_id)
    {
        return $this->vendor->notices()->find($notice_id);
    }

    /**
     * @return mixed
     */
    public static function options()
    {
        return static::pluck('name', 'id')->toArray();
    }

    /**
     * @return Notification
     */
    public function newNotification()
    {
        $notification = new Notification;
        $notification->user()->associate($this);
     
        return $notification;
    }

    /**
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
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
