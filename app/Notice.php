<?php namespace App;

use Carbon\Carbon;
use App\Traits\DateAccessor;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class Notice extends Model
{
    use RevisionableTrait,
        DateAccessor,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'name',
        'number',
        'description',
        'rules',
        'price',
        'published_at',
        'expired_at',
        'purchased_at',
        'submission_at',
        'submission_address',
        'notice_type_id',
        'notice_category_id',
        'organization_id',
        'status',
    ];

    protected $attributes = [
        'status' => 'draft'
    ];

    protected $searchable = [
        'name',
        'number',
        'published_at',
        'status',
    ];

    protected $sortable = [
        'name',
        'number',
        'published_at',
        'status',
    ];

    protected $dates = [
        'published_at',
        'expired_at',
        'purchased_at',
        'submission_at'
    ];

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

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeAwarded($query)
    {
        return $query->where('status', 'awarded');
    }

    public function scopeLimited($query)
    {
        return $query->where('status', 'limited');
    }

    /* 
     * State controls 
     */
    public function canPublish()
    {
        return $this->status != 'published' && $this->status != 'cancelled';
    }

    public function canUnpublish()
    {
        return $this->status == 'published';
    }

    public function canCancel()
    {
        return $this->status != 'cancelled';
    }
    
    public function canAward()
    {
        return $this->status != 'awarded' && $this->status != 'cancelled';
    }

    /*
     * Relationship
     */

    public function type()
    {
        return $this->belongsTo(NoticeType::class, 'notice_type_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function allocations()
    {
        return $this->belongsToMany(Allocation::class)
            ->withPivot(['id', 'amount'])
            ->wherePivot('deleted_at', NULL)
            ->withTimestamps();
    }

    public function activities()
    {
        return $this->hasMany(NoticeActivity::class);
    }

    public function qualifications()
    {
        return $this->hasMany(NoticeQualification::class);
    }

    public function requirementCommercials()
    {
        return $this->hasMany(SubmissionRequirement::class)->where('type_id', '1');
    }

    public function requirementTechnicals()
    {
        return $this->hasMany(SubmissionRequirement::class)->where('type_id', '2');
    }

    public function events()
    {
        return $this->hasMany(NoticeEvent::class);
    }

    public function vendors()
    {
        return $this->belongsToMany(Vendor::class)
            ->withTimestamps();
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function evaluators()
    {
        return $this->belongsToMany(User::class, 'notice_evaluator')
            ->withPivot(['type_id', 'status'])
            ->withTimestamps();
    }

    public function transactionDetails()
    {
        return $this->morphMany(TransactionDetail::class, 'detailable');
    }

    public function evaluationRequirements()
    {
        return $this->hasMany(EvaluationRequirement::class);
    }

    public function bookmarks()
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }

    public function invitations()
    {
        return $this->belongsToMany(Vendor::class, 'notice_invitation');
    }

    public function settings()
    {
        return $this->morphMany(Setting::class, 'item');
    }
    
    /*
     * Helpers
     */

    public static function options()
    {
        return static::pluck('name','id');
    }

    public function isExpired()
    {
        return Carbon::today()->toDateString() >= $this->expired_at;
    }

    public static function published()
    {
        return static::where('status', 'published');
    }

    public static function limited()
    {
        return static::where('status', 'limited');
    }

    public function getSummary()
    {
        // Fixme: try to create dynamic query for evaluation type other than commercial and technical.
        $this->type_id = [
            ['id' => '1', 'name' => 'Commercials'],
            ['id' => '2', 'name' => 'Technicals']
        ];

        $vendors = Vendor::leftJoin('submissions', 'submissions.vendor_id', '=', 'vendors.id')
            ->where('submissions.notice_id', $this->id)
            ->select([
                'vendors.id',
                'vendors.name',
                'submissions.price as offered_price',
                \DB::raw("'None' as offered_duration")
            ])
            ->groupBy('vendors.id')
            ->get();

        foreach ($vendors as $vendor) {
            foreach ($this->type_id as $type) {
                $score = EvaluationRequirement::where('notice_id', $this->id)
                    ->where('evaluation_requirements.evaluation_type_id', $type['id'])
                    ->leftJoin('evaluation_scores', 'evaluation_scores.evaluation_requirement_id', '=', 'evaluation_requirements.id')
                    ->select(
                        \DB::raw("FORMAT((SUM(evaluation_scores.score) / SUM(evaluation_requirements.full_score)) * 100, 2) as value")
                    )
                    ->first();

                $vendor->{$type['name']} = $score['value'];
                $types[] = $type['name'];
            }
        }

        $summary['data'] = $vendors->sortBy('Commercials'); // Fixme: create dynamic sorting
        $summary['types'] = $types;

        return $summary;
    }
}
