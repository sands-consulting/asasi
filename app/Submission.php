<?php namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;
use App\Libraries\Traits\DateAccessorTrait;

class Submission extends Model
{
    use RevisionableTrait,
        DateAccessorTrait,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'type',
        'price',
        'notice_id',
        'vendor_id',
        'status'
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
    
    public function canSubmit()
    {
        return $this->status === 'completed';
    }

    /*
     * Relationship
     */

    public function notice()
    {
        return $this->belongsTo(Notice::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function details()
    {
        return $this->hasMany(SubmissionDetail::class);
    }

    public function scores()
    {
        return $this->hasMany(EvaluationScore::class);
    }

    public function evaluators()
    {
        return $this->belongsToMany(NoticeEvaluator::class, 'submission_evaluator', 'submission_id', 'evaluator_id')
            ->withPivot(['status'])
            ->withTimestamps();
    }

    public function scoreAverage()
    {
      return $this->hasOne(EvaluationScore::class)
        ->selectRaw('submission_id, avg(score) as score_avg')
        ->groupBy('submission_id');
    }

    public function type()
    {
        return $this->belongsTo(EvaluationType::class, 'type_id');
    }

    /*
     * accessors
     */
    public function getScoreAvgAttribute()
    {
        // if relation is not loaded already, let's do it first
        if ( ! array_key_exists('scoreAverage', $this->relations)) 
        $this->load('scoreAverage');

        $related = $this->getRelation('scoreAverage');

        // then return the count directly
        return ($related) ? (int) $related->score_avg : 0;
    }
    
    /**
     * Helpers
     */

    public function getProgress()
    {
        $progress = 0;

        $evaluators = $this->evaluators()->count();
        $completed = $this->evaluators()->wherePivot('status', 'completed')->count();
        if ($evaluators > 0 && $completed > 0) {
            $progress = $completed/$evaluators * 100;
        }
        return $progress;
    }
}
