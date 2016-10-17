<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class QualificationCodeType extends Model
{
    use RevisionableTrait, SoftDeletes;

    protected $fillable = [
        'name',
        'status',
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
