<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sands\Uploadable\UploadableTrait;
use Venturecraft\Revisionable\RevisionableTrait;

class SubmissionItem extends Model
{
    use RevisionableTrait,
        SoftDeletes,
        UploadableTrait;

    protected $revisionCreationsEnabled = true;

    protected $uploadableConfig = [
        'file.*' => [
            'custom-save', // saves the image prefixed wth "original"
        ],
    ];

    protected $fillable = [
        'value',
        'detail_id',
        'requirement_id',
    ];

    protected $attributes = [];

    protected $searchable = [];

    protected $sortable = [];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /*
     * Search scopes
     */

    public function scopeSort($query, $column, $direction)
    {
        if (in_array($column, $this->sortable) && in_array($direction, ['asc', 'desc'])) {
            $query->orderBy($column, $direction);
        }
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

    /*
     * Relationship
     */

    public function requirement()
    {
        return $this->belongsTo(SubmissionRequirement::class, 'requirement_id')
            ->where('type', $this->submission->type);
    }

    public function evaluation()
    {
        return $this->hasOne(SubmissionEvaluation::class);
    }

    public function detail()
    {
        return $this->belongsTo(SubmissionDetail::class);
    }

    public function upload()
    {
        return $this->belongsTo(Upload::class);
    }

    /*
     * Override functions
     */

    public function detachFiles($forType = null)
    {
        if ($forType) {
            $models = $this->uploads()->where('type', $forType)->get();
        } else {
            $models = $this->uploads;
        }

        $models->each(function ($model) {
            $model->delete();
        });
    }

    public function uploads()
    {
        // Fixme: handle soft delete file.
        return $this->morphMany(CustomUpload::class, 'uploadable')
            ->whereNull('deleted_at');
    }


    public function attachFiles($file, $forType = null)
    {
        $attached = '';
        foreach ($this->uploadableConfig as $type => $filters) {
            if ($forType && $type != $forType) {
                continue;
            }

            if (! is_null($file)) {
                $attached = $this->processFile($type, $file, $filters);
            }
        }
        return $attached;
    }

    /**
     * Helpers
     */

    /*
     * Boot
     */

    public static function boot()
    {
        self::deleted(function (SubmissionDetail $submissionDetail) {
            $submissionDetail->detachFiles();
        });
    }
}
