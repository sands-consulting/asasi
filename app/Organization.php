<?php namespace App;

use Baum\Node;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orchestra\Support\Traits\QueryFilter;
use Venturecraft\Revisionable\RevisionableTrait;

class Organization extends Node
{
    use RevisionableTrait, SoftDeletes;

    protected $fillable = [
        'name',
        'short_name',
        'status',
    ];

    protected $attributes = [
        'status' => 'active',
    ];

    protected $searchable = [
        'name',
        'short_name',
    ];

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
     * Wildcard Serch
     */
    public function scopeSearch($query, $keyword = '')
    {
        return $this->setupWildcardQueryFilter($query, $keyword, $this->searchable);
    }

    public function scopeSort($query, $inputs)
    {
        $orderBy    = $this->getBasicQueryOrderBy($inputs);
        $direction  = $this->getBasicQueryDirection($inputs);
        ! empty($orderBy) && $query->orderBy($orderBy, $direction);
        return $query;
    }
}
