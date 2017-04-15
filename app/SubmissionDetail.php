<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class SubmissionDetail extends Model
{
    use RevisionableTrait,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'submission_id',
        'type_id',
        'user_id',
        'completed_at',
        'status',
    ];

    protected $attributes = [
        'status' => 'pending',
    ];

    protected $searchable = [];

    protected $sortable = [];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /*
     * Search scopes
     */
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

    /*
     * Relationship
     */

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        return $this->belongsTo(EvaluationType::class, 'type_id');
    }

    public function items()
    {
        return $this->hasMany(SubmissionItem::class, 'detail_id');
    }

    /**
     * Helpers
     */


    /*
     * Boot
     */
    public static function boot()
    {
        parent::boot();
    }
}
