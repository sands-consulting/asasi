<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class SubmissionEvaluation extends Model
{
    use RevisionableTrait,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'rating',
        'remark',
        'submission_detail_id',
    ];

    protected $hidden = [
        // hidden column
    ];

    protected $attributes = [
        // default attributes value
    ];

    protected $searchacble = [
        // fields
    ];

    protected $sortable = [
        // fields
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

    public function scopeEvaluatorId($query, $userId)
    {
        return $query->whereUserId($userId);
    }

    /* 
     * State controls 
     */

    // public function sluggable()
    // {
    //     return [
    //         'slug' => [
    //             'source' => ''
    //         ]
    //     ];
    // }

    /*
     * Relationship
     */
    
    public function submissionDetail()
    {
        return $this->belongsTo(SubmissionDetail::class);
    }

    /*
     * Helpers 
     */

    /*
     * Boot
     */
    public static function boot()
    {
        parent::boot();
    }

}
