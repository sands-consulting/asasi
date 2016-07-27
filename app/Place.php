<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class Place extends Model
{
    use RevisionableTrait,
        Sluggable,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'name',
        'type',
        'code_2',
        'code_3',
        'place_id',
        'status'
    ];

    protected $attributes = [
        'status' => 'active',
    ];

    protected $searchable = [
        'name',
        'code_2',
        'code_3'
    ];

    protected $sortable = [
        'name',
        'code_2',
        'code_3'
    ];

    public static $types = [
        'city',
        'state',
        'country'
    ];

    public function logs()
    {
        return $this->morphMany(UserLog::class, 'actionable');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    /*
     * Search scopes
     */

    public function scopeSearch($query, $queries = [])
    {
        if (isset($queries['keywords']) && !empty($queries['keywords'])) {
            $keywords = $queries['keywords'];
            foreach ($this->searchable as $column) {
                $query->orWhere("{$this->getTable()}.{$column}", 'LIKE', "%$keywords%");
            }
            unset($queries['keywords']);
        }

        foreach ($queries as $key => $value) {
            if (empty($value)) {
                continue;
            }
            $query->orWhere("{$this->getTable()}.{$key}", $value);
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

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public static function getNestedList($label, $key, $sep=' ')
    {
        $options = [];

        foreach(self::whereStatus('active')->whereType('country')->orderBy('name')->get() as $country)
        {
            $options[$country->{$key}] = $country->{$label};

            foreach($country->children()->whereStatus('active')->orderBy('name')->get() as $state)
            {
                $options[$state->{$key}] = $sep . ' ' . $state->{$label};

                foreach($state->children()->whereStatus('active')->orderBy('name')->get() as $city)
                {
                    $options[$city->{$key}] = $sep . $sep . ' ' . $city->{$label};
                }
            }
        }

        return $options;
    }

    public static function boot()
    {
        parent::boot();
    }

}
