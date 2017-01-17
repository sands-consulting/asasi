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
    	'file_id',
    	'upload_id',
    	'vendor_id'
    ];

    protected $uploadableConfig = [
        'file' => [
            'custom-save', // saves the image prefixed wth "original"
        ]
    ];

    public function file()
    {
    	return $this->belongsTo(File::class);
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
