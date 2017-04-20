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

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function requirement()
    {
        return $this->belongsTo(SubmissionRequirement::class)
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
}
