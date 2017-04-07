<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class VendorEmployee extends Model
{
    use RevisionableTrait,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
    	'name',
    	'designation',
    	'role',
        'nationality_id'
    ];

    public static $roles = [
        'management',
        'executive',
        'non-executive'
    ];

    public function vendor()
    {
    	return $this->belongsTo(Vendor::class);
    }
}
