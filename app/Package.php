<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class Package extends Model
{
    use RevisionableTrait,
        Sluggable,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'name',
        'description',
        'label_color',
        'validity_type',
        'validity_quantity',
        'meta',
        'fee',
        'tax_code_id',
        'status',
    ];

    protected $hidden = [
        // hidden column
    ];

    protected $appends = [
        'validity'
    ];

    protected $attributes = [
        // default attributes value
        'status' => 'active'
    ];

    protected $searchacble = [
        'name',
        'validity_type',
        'validity_quantity',
        'meta',
        'fee',
        'status',
    ];

    protected $sortable = [
        'name',
        'validity_type',
        'validity_quantity',
        'meta',
        'fee',
        'status',
    ];

    public function logs()
    {
        return $this->morphMany(UserHistory::class, 'actionable');
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

    public function getValidityAttribute()
    {
        return trans_choice('packages.validity.' . $this->validity_type, $this->validity_quantity);
    }

    public function taxCode()
    {
        return $this->belongsTo(TaxCode::class);
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /*
     * Helpers 
     */

    public static function options()
    {
        return Package::pluck('name', 'id')->toArray();
    }
}
