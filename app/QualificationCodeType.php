<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

class QualificationCodeType extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'status',
    ];

    protected $attributes = [
        'status' => 'active',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function getFullNameAttribute()
    {
        return $this->getAncestorsAndSelf()->map(function ($qualificationCodeType) {
            return $qualificationCodeType->name;
        })->implode(' > ');
    }
}
