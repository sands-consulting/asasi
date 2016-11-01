<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class NoticeEvaluator extends Model
{
    use RevisionableTrait,
        SoftDeletes;

    protected $table = 'notice_evaluator';

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'notice_id',
        'user_id',
        'type_id',
        'status',
    ];

    protected $hidden = [
        // hidden column
    ];

    protected $attributes = [
        'status' => 'pending'
    ];

    protected $searchacble = [
        // fields
    ];

    protected $sortable = [
        // fields
    ];

    public function logs()
    {
        return $this->morphMany(UserLog::class, 'actionable');
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

    public function scopeType($query, $type)
    {
        return $query->where('type_id', $type);
    }
    
    /*
     * Relationsip
     */
    
    public function notice()
    {
        return $this->belongsTo(Notice::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        return $this->belongsTo(EvaluationType::class, 'type_id');
    }

    public function submissions()
    {
        return $this->belongsToMany(Submission::class, 'submission_evaluator', 'evaluator_id', 'submission_id')
            ->withPivot(['status'])
            ->withTimestamps();
    }

    /* 
     * State controls 
     */

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

    public function getProgress($type)
    {
        $progress = 0;
        $total = $this->submissions()->where('type', $type)->count();
        $completed = $this->submissions()->where('type', $type)
                ->wherePivot('status', 'completed')
                ->count();

        if ($total > 0) 
            $progress = $completed/$total * 100;

        return $progress;
        // return number_format($progress, 2, '.', '');

    }

    public static function boot()
    {
        parent::boot();
    }

}
