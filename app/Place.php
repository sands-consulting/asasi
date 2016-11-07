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
        'parent_id',
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
            $query->where(function($query) use($keywords) {
                foreach ($this->searchable as $column) {
                    $query->orWhere("{$this->getTable()}.{$column}", 'LIKE', "%$keywords%");
                }
            });
            unset($queries['keywords']);
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

    public function scopeActive($query)
    {
        return $query->whereStatus('active');
    }

    public function scopeType($query, $type)
    {
        return $query->whereType($type);
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

    /*
     * Helpers 
     */

    public static function cityOptions()
    {
        // Fixme: Temp code to select state
        $cities = static::where('status', 'active')
            ->where('type', 'city')
            ->lists('name', 'id');

        return ['' => 'Select city ...'] + $cities->toArray();
    }

    public static function stateOptions()
    {
        // Fixme: Temp code to select state
        $states = static::where('status', 'active')
            ->where('type', 'state')
            ->lists('name', 'id');

        return ['' => 'Select state ...'] + $states->toArray();
    }

    public static function countryOptions()
    {
        // Fixme: Temp code to select state
        $countries = static::where('status', 'active')
            ->where('type', 'country')
            ->lists('name', 'id');

        return ['' => 'Select country ...'] + $countries->toArray();
    }


    public static function boot()
    {
        parent::boot();
    }

}
