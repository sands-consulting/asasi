<?php namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;
use App\Libraries\Traits\DateAccessorTrait;

class NoticeEvent extends Model
{
    use RevisionableTrait,
        DateAccessorTrait,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'name',
        'event_at',
        'location',
        'required',
        'notice_id',
        'notice_event_type_id',
        'status',
    ];

    protected $attributes = [
        'status' => 'active'
    ];

    protected $searchable = [
        'name',
        'event_at',
        'location',
        'status',
    ];

    protected $sortable = [
        'name',
        'event_at',
        'location',
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
        return $this->status != 'active' && $this->status != 'cancelled';
    }

    public function canInactivate()
    {
        return $this->status != 'inactive' && $this->status != 'cancelled';
    }

    public function canCancel()
    {
        return $this->status != 'cancelled';
    }
    
    /*
     * Relationship
     */

    public function activities()
    {
        return $this->morphMany(NoticeActivity::class, 'activitable');
    }

    public function type()
    {
        return $this->belongsTo(NoticeEventType::class, 'notice_event_type_id');
    }

    /**
     * Helpers
     */
    
    public static function options()
    {
        return static::lists('name', 'id');
    }
}