<?php

namespace App;

use Carbon\Carbon;
use App\Traits\DateAccessor;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class Notice extends Model
{
    use DateAccessor,
        RevisionableTrait,
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
        'tax_code_id',
        'type_id',
        'category_id',
        'organization_id',
        'status',
        'status_submission',
        'status_award',
        'invitation'
    ];

    protected $attributes = [
        'status' => 'draft',
        'status_submission' => 'pending',
        'status_award' => 'pending'
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
        'submission_at',
    ];

    /*
     * Query Scopes
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

    public function scopeSubmissionPublished($query)
    {
        return $query->where('status_submission', 'published');
    }

    public function scopeAwarded($query)
    {
        return $query->where('status_award', 'awarded');
    }

    /*
     * Relationships
     */

    public function settings()
    {
        return $this->morphMany(Setting::class, 'item');
    }

    public function type()
    {
        return $this->belongsTo(NoticeType::class);
    }

    public function category()
    {
        return $this->belongsTo(NoticeCategory::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function taxCode()
    {
        return $this->belongsTo(TaxCode::class);
    }

    public function events()
    {
        return $this->hasMany(NoticeEvent::class);
    }

    public function qualificationCodes()
    {
        return $this->hasMany(NoticeQualificationCode::class);
    }

    public function files()
    {
        return $this->hasMany(NoticeFile::class);
    }

    public function allocations()
    {
        return $this->belongsToMany(Allocation::class)
            ->withPivot(['id', 'amount'])
            ->wherePivot('deleted_at', NULL)
            ->withTimestamps();
    }

    public function submissionRequirements()
    {
        return $this->hasMany(SubmissionRequirement::class);
    }

    public function evaluationRequirements()
    {
        return $this->hasMany(EvaluationRequirement::class);
    }

    public function activities()
    {
        return $this->hasMany(NoticeActivity::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function evaluationSettings()
    {
        return $this->hasMany(NoticeEvaluation::class);
    }

    public function evaluators()
    {
        return $this->belongsToMany(User::class, 'notice_evaluator')
            ->withPivot(['type_id', 'status'])
            ->withTimestamps();
    }

    public function bookmarks()
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }

    public function eligibles()
    {
        return $this->hasMany(NoticeEligible::class);
    }

    public function invitations()
    {
        return $this->hasMany(NoticeInvitation::class);
    }

    public function purchases()
    {
        return $this->hasMany(NoticePurchase::class);
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
