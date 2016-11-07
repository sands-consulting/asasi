<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class VendorFile extends Model
{
    use RevisionableTrait,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
    	'file_id',
    	'upload_id',
    	'vendor_id'
    ];

    public function file()
    {
    	return $this->belongsTo(File::class);
    }

    public function file()
    {
    	return $this->belongsTo(Upload::class);
    }

    public function vendor()
    {
    	return $this->belongsTo(Vendor::class);
    }
}
