<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class Evaluation extends Model
{
    use RevisionableTrait,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'remarks',
        'total_score',
        'notice_id',
        'submission_id',
        'type_id',
        'user_id',
        'status',
    ];

    protected $appends = [
        'url_edit',
        'status_label',
    ];

    protected $hidden = [
    ];

    protected $attributes = [
        'status' => 'pending'
    ];

    public function scopeType($query, $typeId)
    {
        return $query->whereTypeId($typeId);
    }

    public function scopeActive($query)
    {
        return $query->whereStatus('active');
    }
    
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

    public function type()
    {
        return $this->belongsTo(EvaluationType::class);
    }

    public function requirement()
    {
        return $this->belongsTo(EvaluationRequirement::class);
    }

    public function scores()
    {
        return $this->hasMany(EvaluationScore::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

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

    public function getScore($requirementId)
    {
        $score = $this->scores()->whereRequirementId($requirementId)->first();

        if($score)
        {
            return $score->score;
        }
        else
        {
            return null;
        }
    }

    public function getRemarks($requirementId)
    {
        $score = $this->scores()->whereRequirementId($requirementId)->first();

        if($score)
        {
            return $score->remarks;
        }
        else
        {
            return null;
        }
    }

    
    public function getStatusLabelAttribute()
    {
        switch ($this->status) {
            case 'pending':
                    $class = 'label label-warning';
                break;
            case 'accepted':
                    $class = 'label label-success';
                break;
            case 'rejected':
                    $class = 'label label-danger';
                break;
            default:
                    $class = 'label label-default';
                break;
        }

        return "<span class=\"{$class}\">$this->status</span>";
    }

    public function getUrlEditAttribute()
    {
        return route('admin.evaluations.edit', $this->id);
    }

    public static function boot()
    {
        parent::boot();

        self::saving(function($evaluation) {
            $evaluation->submission->calculateOverallPercentage()->save();
        });
    }
}
