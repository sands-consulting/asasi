<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;
use App\Traits\DateAccessor;

class Submission extends Model
{
    use RevisionableTrait,
        DateAccessor,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'number',
        'label',
        'price',
        'duration',
        'notice_id',
        'vendor_id',
        'purchase_id',
        'status',
        'submitted_at',
    ];

    protected $appends = [
        'duration_in_text'
    ];

    protected $attributes = [
        'status' => 'draft',
    ];

    protected $searchable = [
        'status',
    ];

    protected $sortable = [
        'status',
    ];

    protected $dates = [
        'submitted_at',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($submission) {
            if ($submission->status == 'submitted' && empty($submission->number)) {
                $submission->number = strtoupper(strtoupper(str_random(8)));
            }
        });
    }

    public function scopeSearch($query, $queries = [])
    {
        if (isset($queries['keywords']) && ! empty($queries['keywords'])) {
            $keywords = $queries['keywords'];
            $query->where(function ($query) use ($keywords) {
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

    public function notice()
    {
        return $this->belongsTo(Notice::class);
    }

    public function purchase()
    {
        return $this->belongsTo(NoticePurchase::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function requirements()
    {
        return $this->belongsToMany(EvaluationRequirement::class, 'evaluation_scores')
            ->wherePivot('deleted_at', null)
            ->withPivot(['score'])
            ->withTimestamps();
    }

    public function type()
    {
        return $this->belongsTo(EvaluationType::class);
    }

    public function details()
    {
        $this->hasMany(SubmissionDetail::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function getProgressAttribute()
    {
        $progress = 0;

        $evaluators = $this->evaluators()->count();
        $completed = $this->evaluators()->wherePivot('status', 'completed')->count();
        if ($evaluators > 0 && $completed > 0) {
            $progress = $completed / $evaluators * 100;
        }
        return $progress;
    }

    public function getDurationInTextAttribute()
    {
        return $this->duration ? trans_choice('submissions.durations.' . setting('duration', 'days', $this->notice), $this->duration) : null;
    }

    public function averageScore($typeId)
    {
        return (int) $this->evaluations()->whereStatus('completed')->whereTypeId($typeId)->avg('score');
    }

    public function totalScore($typeId)
    {
        return (int) $this->notice->evaluationRequirements()->whereStatus('active')->whereTypeId($typeId)->sum('full_score');
    }

    public function averagePercentage($typeId)
    {
        $setting    = $this->notice->evaluationSettings()->whereTypeId($typeId)->get();
        $count      = $this->evaluations()->whereStatus('completed')->whereTypeId($typeId)->count();

        if($setting && $count > 0)
        {
            $value = $this->averageScore($typeId);
            $value = $value / $count;
            $value = $value * 100;
            $value = $value * $setting->weightage;
            return $value;
        }
        else
        {
            return 0;
        }
    }

    public function overallPercentage()
    {
        $percentage = 0.00;

        foreach($this->notice->evaluationSettings()->get() as $setting)
        {
            $percentage = $percentage + $this->averagePercentage($setting->type_id);
        }

        return $percentage;
    }
}
