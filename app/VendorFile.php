<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sands\Uploadable\UploadableTrait;
use Venturecraft\Revisionable\RevisionableTrait;

class VendorFile extends Model
{
    use RevisionableTrait,
        SoftDeletes,
        UploadableTrait;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'type_id',
    	'upload_id',
    	'vendor_id'
    ];

    public function type()
    {
    	return $this->belongsTo(FileType::class);
    }

    public function upload()
    {
    	return $this->belongsTo(Upload::class);
    }

    public function vendor()
    {
    	return $this->belongsTo(Vendor::class);
    }
}
