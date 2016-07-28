<?php namespace App;

use Cache;
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
        'status'
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

    public function logs()
    {
        return $this->morphMany(UserLog::class, 'actionable');
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
        return $this->hasOne(Vendor::class);
    }

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

    protected function cachedPermissions()
    {
        $that = $this;
        return Cache::rememberForever('user_permissions_'.$this->getKey(), function () use ($that) {
            return Permission::join('permission_role', 'permission_role.permission_id', '=', 'permissions.id')
                                        ->whereIn('permission_role.role_id', $that->roles->lists('id')->toArray())
                                        ->lists('name')
                                        ->toArray();
        });
    }

    public static function boot()
    {
        parent::boot();
    }
}
