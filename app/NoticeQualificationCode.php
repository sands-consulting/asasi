<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class NoticeQualificationCode extends Model
{
    use RevisionableTrait,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'group',
        'sequence',
        'group_rule',
        'join_rule',
        'code_id',
        'type_id'
    ];

    protected $attributes = [
        'group_rule' => 'OR',
        'join_rule' => 'OR'
    ];

    public function code()
    {
        return $this->belongsTo(QualificationCode::class, 'code_id');
    }

    public function type()
    {
        return $this->belongsTo(QualificationType::class, 'type_id');
    }

    public function notice()
    {
        return $this->belongsTo(Notice::class);
    }
}
