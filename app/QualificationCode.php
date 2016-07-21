<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

class QualificationCode extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'type_id',
        'status',
    ];

    protected $attributes = [
        'status' => 'active',
    ];

    public function type()
    {
        return $this->belongsTo(QualificationCodeType::class);
    }

    public function getFullNameAttribute()
    {
        return $this->getAncestorsAndSelf()->map(function ($qualificationCode) {
            return $qualificationCode->name;
        })->implode(' > ');
    }
}
