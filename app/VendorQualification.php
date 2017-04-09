<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class VendorQualification extends Model
{
    use RevisionableTrait,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'reference_one',
        'reference_two',
        'start_at',
        'end_at',
        'type_id'
    ];

    protected $dates = [
        'start_at',
        'end_at'
    ];

    public function type()
    {
        return $this->belongsTo(QualificationType::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
