<?php namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;
use App\Traits\DateAccessor;

class SubmissionRequirement extends Model
{
    use RevisionableTrait,
        DateAccessor,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'type_id',
        'title',
        'field_required',
        'field_type',
        'notice_id',
        'sequence'
    ];

    protected $attributes = [
        'status' => 'active'
    ];

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
}
