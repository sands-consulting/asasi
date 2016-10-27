<?php namespace App;

use Cache;
use Cart;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class User extends Authenticatable
{
    use RevisionableTrait,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'confirmation_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $attributes = [
        'status' => 'inactive',
    ];

    protected $searchable = [
        'name',
        'email'
    ];

    protected $sortable = [
        'name',
        'email',
        'status'
    ];

    /*
     * Relationship
     */
    
    public function logs()
    {
        return $this->morphMany(UserLog::class, 'actionable');
    }

    public function bookmarks()
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }

    public function blacklists()
    {
        return $this->hasMany(UserBlacklist::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function vendor()
    {
        return $this->belongsToMany(Vendor::class)
            ->wherePivot('status', 'active');
    }

    public function vendors()
    {
        return $this->belongsToMany(Vendor::class);
    }

    public function organizations()
    {
        return $this->belongsToMany(Organization::class);
    }

    public function subscriptions()
    {
        return $this->vendor->first()->subscriptions;
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

    /*
     * Search scopes
     */

    public function scopeSearch($query, $queries = [])
    {
        if (isset($queries['keywords']) && !empty($queries['keywords'])) {
            $keywords = $queries['keywords'];
            $query->where(function($query) use($keywords) {
                foreach ($this->searchable as $column) {
                    $query->orWhere("{$this->getTable()}.{$column}", 'LIKE', "%$keywords%");
                }
            });
            $query->orWhereHas('vendors', function($query) use($keywords) {
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

    public function scopeEvaluators($query)
    {
        $query->whereHas('roles', function($roles) {
            return $roles->whereName('evaluator');
        });
    }

    /* 
     * State controls 
     */
    public function canActivate()
    {
        return $this->status != 'active';
    }

    public function canSuspend()
    {
        return $this->status != 'suspended';
    }

    public function canAddNoticeToCart(Notice $notice)
    {
        $inCart = Cart::content()->search(function($cartItem) use ($notice){
            return $cartItem->id === $notice->id;
        });

        return $this->hasSubscription() && !$this->hasBoughtNotice($notice->id) && !$inCart;
    }
    /*
     * ACL functions
     */

    public function hasRole($role)
    {
        return $this->roles()->whereName($role)->count() == 1;
    }

    public function hasRoles($roles)
    {
        return $this->roles()->whereName($roles)->count() > 0;
    }

    public function hasPermission($permission)
    {
        return in_array($permission, $this->cachedPermissions());
    }

    public function hasPermissions($permissions=[])
    {
        return count(array_intersect($this->cachedPermissions(), $permissions)) > 0;
    }

    public function hasAllPermissions($permissions=[])
    {
        return count(array_intersect($this->cachedPermissions(), $permissions)) == count($permissions);
    }

    public function hasSubscription()
    {
        $vendor = $this->vendor()->with('subscriptions')->first();
        return $vendor->subscriptions->count() > 0;
    }

    public function hasBoughtNotice($notice)
    {
        $vendor = $this->vendor()->with(['notices' => function($query) use ($notice) {
            return $query->where('notices.id', $notice);
        }])->first();

        return $vendor->notices->count() > 0;
    }

    /*
     * Permissions caching
     */

    public function cachedPermissions()
    {
        if( ! Cache::has($this->permissions_cache_key) )
        {
            $this->cachePermissions();
        }

        return Cache::get($this->permissions_cache_key);
    }

    public function cachePermissions()
    {
        if(Cache::has('user_'))
        {
            Cache::forget($this->permissions_cache_key);
        }

        $that = $this;
        Cache::rememberForever($this->permissions_cache_key, function () use ($that) {
            return Permission::join('permission_role', 'permission_role.permission_id', '=', 'permissions.id')
                                        ->whereIn('permission_role.role_id', $that->roles->lists('id')->toArray())
                                        ->lists('name')
                                        ->toArray();
        });
    }

    protected function getPermissionsCacheKeyAttribute()
    {
        return 'user_permissions_' . $this->getKey();
    }

    /*
     * Helpers
     */
    
    public static function options()
    {
        return static::lists('name','id')->toArray();
    }
    
    /**
     * Boot
     */

    public static function boot()
    {
        parent::boot();

        parent::creating(function($user) {
            $user->confirmation_token = str_random(64);
        });
    }
}
