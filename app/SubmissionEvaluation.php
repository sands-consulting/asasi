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

    public function histories()
    {
        return $this->morphMany(UserHistory::class, 'actionable');
    }

    public function scopeEvaluatorId($query, $userId)
    {
        return $query->whereUserId($userId);
    }
    
    public function submissionDetail()
    {
        return $this->belongsTo(SubmissionDetail::class);
    }
}
