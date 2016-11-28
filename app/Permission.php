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

    protected $searchable = [
        'group',
        'name',
        'description'
    ];

    protected $sortable = [
        'group',
        'name',
        'description'
    ];


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

        if (isset($queries['group']) && !empty($queries['group'])) {
            $group = $queries['group'];
            $query->whereGroup($group);
            unset($queries['group']);
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
     * Relationship
     */
    
    public function logs()
    {
        return $this->morphMany(UserLog::class, 'actionable');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /*
     * Helpers
     */
    
    public static function getGroupOptions()
    {
        return static::distinct('group')->orderBy('group')->lists('group');
    }

    /**
     * Get user of a permission.
     * @return Array Array of App\User object.
     */
    public function getUsers()
    {   
        $users = $this->roles->reduce(function ($carry, $role) {
            foreach($role->users as $user) {
                $carry[] = $user;
            }
            return $carry;
        }, []);

        return $users;
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($permission) {
            $permission->group = explode(':', $permission->name)[0];
        });
    }
}
