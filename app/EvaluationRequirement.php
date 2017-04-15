<?php namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;
use App\Traits\DateAccessor;

class EvaluationRequirement extends Model
{
    use RevisionableTrait,
        DateAccessor,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'sequence',
        'title',
        'full_score',
        'required',
        'type_id',
        'notice_id',
        'status'
    ];

    protected $attributes = [
        'status' => 'active'
    ];

    protected $searchable = [];

    protected $sortable = [];

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

    public function notice()
    {
        return $this->belongsTo(Notice::class);
    }

    public function type()
    {
        return $this->belongsTo(EvaluationType::class);
    }

    public function scores()
    {
        return $this->hasMany(EvaluationScore::class);
    }

    public function submissions()
    {
        return $this->belongsToMany(Submission::class, 'evaluation_scores')
            ->wherePivot('deleted_at', null)
            ->withPivot(['score'])
            ->withTimestamps();
    }
}
