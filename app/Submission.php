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

    protected $attributes = [
        'status' => 'draft'
    ];

    protected $searchable = [
        'status'
    ];

    protected $sortable = [
        'status'
    ];

    protected $dates = [
        'submitted_at',
    ];

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

    public function type()
    {
        return $this->belongsTo(EvaluationType::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function details($type = null)
    {
        $details = $this->hasMany(SubmissionDetail::class);
        
        if (!is_null($type))
        {
            $details->where('type_id', $type);
        }

        return $details;
    }

    public function averageScore($typeId)
    {
        return (int) $this->evaluations()->whereTypeId($typeId)->avg('score');
    }

    public function getProgressAttribute()
    {
        $progress = 0;

        $evaluators = $this->evaluators()->count();
        $completed = $this->evaluators()->wherePivot('status', 'completed')->count();
        if ($evaluators > 0 && $completed > 0) {
            $progress = $completed/$evaluators * 100;
        }
        return $progress;
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function($submission)
        {
            if($submission->status == 'submitted' && empty($submission->number))
            {
                $submission->number = strtoupper(strtoupper(str_random(8)));
            }
        });
    }
}
