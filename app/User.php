<?php namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;

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

    public function logs()
    {
        return $this->hasMany(UserLog::class);
    }

    public function blacklists()
    {
        return $this->hasMany(UserBlacklist::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
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
                                        ->where('permission_role.role_id', $that->roles->lists('id')->toArray())
                                        ->lists('name')
                                        ->toArray();
        });
    }
}
