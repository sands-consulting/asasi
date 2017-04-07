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
        'fee_amount',
        'fee_tax_code',
        'fee_tax_rate',
        'status',
    ];

    protected $hidden = [
        // hidden column
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
        'fee_amount',
        'fee_tax_code',
        'fee_tax_rate',
        'status',
    ];

    protected $sortable = [
        'name',
        'validity_type',
        'validity_quantity',
        'meta',
        'fee_amount',
        'fee_tax_code',
        'fee_tax_rate',
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

    /*
     * Helpers 
     */

    public static function options()
    {
        return ['' => 'Select One'] + Package::pluck('name', 'id')->toArray();
    }

    public static function boot()
    {
        parent::boot();
    }

}
