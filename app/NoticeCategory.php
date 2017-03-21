<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;
use App\Traits\DateAccessor;

class NoticeCategory extends Model
{
    use RevisionableTrait,
        DateAccessor,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'name',
        'status',
    ];

    protected $attributes = [
        'status' => 'active'
    ];

    protected $searchable = [
        'name',
        'status',
    ];

    protected $sortable = [
        'name',
        'status',
    ];

    protected $dates = [];

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

    /**
     * Helpers
     */

    public static function options()
    {
        return static::pluck('name','id')->toArray();
    }

    public static function boot()
    {
        parent::boot();
    }
}
