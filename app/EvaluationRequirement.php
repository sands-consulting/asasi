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

    public function scopeType($query, $typeId)
    {
        return $query->whereTypeId($typeId);
    }

    public function scopeActive($query)
    {
        return $query->whereStatus('active');
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
