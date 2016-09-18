<?php namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;
use App\Libraries\Traits\DateAccessorTrait;

class Notice extends Model
{
    use RevisionableTrait,
        DateAccessorTrait,
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

    public function activities()
    {
        return $this->hasMany(NoticeActivity::class);
    }

    public function requirementCommercials()
    {
        return $this->hasMany(RequirementCommercial::class);
    }

    public function requirementTechnicals()
    {
        return $this->hasMany(RequirementTechnical::class);
    }

    public function events()
    {
        return $this->hasMany(NoticeEvent::class);
    }

    public function vendors()
    {
        return $this->hasMany(Vendor::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    /*
     * Helpers
     */

    public function isExpired()
    {
        return Carbon::today()->toDateString() >= $this->expired_at;
    }

    public static function published()
    {
        return static::where('status', 'published');
    }
}
