<?php

namespace App;

use Baum\Node;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class QualificationCodeType extends Node
{
    use RevisionableTrait, SoftDeletes;

    protected $fillable = [
        'name',
        'status',
        'parent_id'
    ];

    protected $attributes = [
        'status' => 'active',
    ];

    public function codes()
    {
        return $this->hasMany(QualificationCode::class, 'type_id');
    }

    public function logs()
    {
        return $this->morphMany(UserLog::class, 'actionable');
    }
}
