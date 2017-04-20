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

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

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
}
