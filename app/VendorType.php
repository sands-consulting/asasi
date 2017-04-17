<?php namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class VendorType extends Model
{
    use RevisionableTrait,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'incorporation_authority',
        'incorporation_type',
        'status'
    ];

    protected $attributes = [
        'status' => 'active'
    ];

    protected $searchable = [
        'incorporation_authority',
        'incorporation_type',
        'status'
    ];

    protected $sortable = [
        'incorporation_authority',
        'incorporation_type',
        'status'
    ];

    /*
     * Helpers
     */

    public static function options()
    {
        $options = static::get()->pluck('label', 'id');
        return $options->toArray();
    }

    /*
     * Search scopes
     */

    public function scopeSearch($query, $queries = [])
    {
        if (isset($queries['keywords']) && !empty($queries['keywords'])) {
            $keywords = $queries['keywords'];
            foreach ($this->searchable as $column) {
                $query->orWhere($column, 'LIKE', "%$keywords%");
            }
            unset($queries['keywords']);
        }

        foreach ($queries as $key => $value) {
            if (empty($value)) {
                continue;
            }
            $query->orWhere($key, $value);
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

    public function getLabelAttribute()
    {
        return implode(' - ', [$this->incorporation_authority, $this->incorporation_type]);
    }

    public static function boot()
    {
        parent::boot();
    }
}
