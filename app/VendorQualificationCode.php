<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class VendorQualificationCode extends Model
{
    use RevisionableTrait,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
    	'code_id',
    	'type_id',
    	'parent_id'
    ];

    public function code()
    {
    	return $this->belongsTo(QualificationCode::class);
    }

    public function type()
    {
    	return $this->belongsTo(QualificationCodeType::class);
    }

    public function parent()
    {
    	return $this->belongsTo(self::class);
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function vendor()
    {
    	return $this->belongsTo(Vendor::class);
    }
}
