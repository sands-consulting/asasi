<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'group', 'name', 'description'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($permission) {
            $permission->group = explode(':', $permission->name)[0];
        });
    }
}
