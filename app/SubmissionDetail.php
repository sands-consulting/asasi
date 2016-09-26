<?php namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sands\Uploadable\UploadableTrait;
use Venturecraft\Revisionable\RevisionableTrait;

class SubmissionDetail extends Model
{
    use RevisionableTrait,
        SoftDeletes,
        UploadableTrait;

    protected $revisionCreationsEnabled = true;

    protected $uploadableConfig = [
        'file' => [
            'custom-save', // saves the image prefixed wth "original"
        ]
    ];

    protected $fillable = [
        'value',
        'requirement_id',
        'submission_id',
        'user_id',
    ];

    protected $attributes = [];

    protected $searchable = [];

    protected $sortable = [];

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
     * Relationship
     */

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }

    public function requirement()
    {
        if ($this->submission->type == 'commercial')
            return $this->belongsTo(RequirementCommercial::class, 'requirement_id');
        else
            return $this->belongsTo(RequirementTechnical::class, 'requirement_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function evaluation()
    {
        return $this->hasOne(SubmissionEvaluation::class);
    }

    public function uploads()
    {
        return $this->morphMany(CustomUpload::class, 'uploadable');
    }

    /**
     * Helpers
     */


    /*
     * Override functions
     */
    public function attachFiles($file, $forType = null)
    {
        $attached = '';
        foreach ($this->uploadableConfig as $type => $filters) {
            if ($forType && $type != $forType) {
                continue;
            }

            if (!is_null($file)) {
                $attached = $this->processFile($type, $file, $filters);
            }
        }
        return $attached;
    }

    /*
     * Boot
     */
    
    public static function boot()
    {
        // self::saved(function (SubmissionDetail $submissionDetail) {
        //     $submissionDetail->attachFiles();
        // });
        self::deleted(function (SubmissionDetail $submissionDetail) {
            $submissionDetail->detachFiles();
        });
    }
}
