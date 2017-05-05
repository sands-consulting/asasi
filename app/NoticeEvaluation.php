<?php

namespace App;

use App\Traits\DateAccessor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class NoticeEvaluation extends Model
{
    use RevisionableTrait,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'start_at',
        'end_at',
        'weightage',
        'type_id',
        'notice_id',
    ];

    public function notice()
    {
        return $this->belongsTo(Notice::class);
    }

    public function type()
    {
        return $this->belongsTo(EvaluationType::class, 'type_id');
    }

}
