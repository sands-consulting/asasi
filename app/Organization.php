<?php namespace App;

use Baum\Node;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class Organization extends Node
{
    use RevisionableTrait,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'name',
        'short_name',
        'parent_id',
        'status',
    ];

    protected $attributes = [
        'status' => 'active',
    ];

    protected $searchable = [
        'name',
        'short_name',
    ];

    protected $sortable = [
        'name',
        'short_name',
        'parent.name',
        'parent.short_name',
        'status'
    ];

    public function logs()
    {
        return $this->morphMany(UserLog::class, 'actionable');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function getFullNameAttribute()
    {
        return $this->getAncestorsAndSelf()->map(function ($organization) {
            return $organization->name;
        })->implode(' > ');
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

        if(isset($queries['parent_id']) && !empty($queries['parent_id'])) {
            $parent_id = $queries['parent_id'];
            $query->where('parent_id', $parent_id);
            unset($queries['parent_id']);
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

    public function canDeactivate()
    {
        return $this->status != 'inactive';
    }

    public function canSuspend()
    {
        return $this->status != 'suspended';
    }

    public static function boot()
    {
        parent::boot();
    }
}
