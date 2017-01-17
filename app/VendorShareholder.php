<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class VendorShareholder extends Model
{
    use RevisionableTrait,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
    	'name',
    	'identity_number',
        'designation',
    	'nationality_id'
    ];

    public function vendor()
    {
    	return $this->belongsTo(Vendor::class);
    }

    public function nationality()
    {
        return $this->belongsTo(Place::class);
    }
}
