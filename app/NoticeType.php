<?php namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class NoticeType extends Model
{
    use RevisionableTrait,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'name',
    ];

    protected $attributes = [
        'status' => 'active'
    ];

    protected $searchable = [
        'name',
        'status'
    ];

    protected $sortable = [
        'name',
        'status',
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

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
    
    /*
     * Relationship
     */

    public function notices()
    {
        return $this->hasMany(Notice::class);
    }

    /**
     * Helpers
     */

    public static function options()
    {
        return ['Select Notice Type'] + static::pluck('name','id')->toArray();
    }
}
