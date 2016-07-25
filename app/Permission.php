<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class Permission extends Model
{
    use RevisionableTrait,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'group',
        'name',
        'description'
    ];

    public function logs()
    {
        return $this->morphMany(UserLog::class, 'actionable');
    }

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
