<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class Evaluation extends Model
{
    use RevisionableTrait,
        SoftDeletes;

    protected $table = 'notice_evaluator';

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'remarks',
        'total_score'
        'notice_id',
        'submission_id',
        'type_id',
        'user_id',
        'status',
    ];

    protected $hidden = [
        //
    ];

    protected $attributes = [
        'status' => 'pending'
    ];

    protected $searchacble = [
        //
    ];

    protected $sortable = [
        //
    ];

    public function scopeType($query, $type)
    {
        return $query->where('type_id', $type);
    }
    
    /*
     * Relationsip
     */
    public function histories()
    {
        return $this->morphMany(UserHistory::class, 'actionable');
    }

    public function notice()
    {
        return $this->belongsTo(Notice::class);
    }

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        return $this->belongsTo(EvaluationType::class, 'type_id');
    }

    /*
     * Helpers 
     */

    public function getProgress($type)
    {
        $progress = 0;
        $total = $this->submissions()->count();
        $completed = $this->submissions()
                ->wherePivot('status', 'completed')
                ->count();

        if ($total > 0) 
            $progress = $completed/$total * 100;

        return $progress;

    }
}
