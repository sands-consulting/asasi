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

    protected $dates = [
        'published_at',
        'expired_at',
        'purchased_at',
        'submission_at',
    ];

    protected $appends = [
        'tax',
        'total'
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

    public function getTaxAttribute()
    {
        if($this->taxCode)
        {
            return $this->price * $this->taxCode->rate / 100;
        }
        else
        {
            return 0.00;
        }
    }

    public function getTotalAttribute()
    {
        return $this->price + $this->tax;
    }

    public function getTransactionLineDescriptionAttribute()
    {
        return sprintf("%s - %s\n%s", $this->organization->name, $this->number, $this->name);
    }
    
    /*
     * Helpers
     */
    public static function options()
    {
        return static::pluck('name','id');
    }

    public function paid($payer)
    {
        $this->purchases()->firstOrCreate(['vendor_id' => $payer->id]);

        return $this;
    }
}
