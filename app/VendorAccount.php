<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class VendorAccount extends Model
{
    use RevisionableTrait,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
    	'account_name',
    	'account_number',
    	'account_bank_name',
    	'account_bank_iban'
    ];

    public function vendor()
    {
    	return $this->belongsTo(Vendor::class);
    }
}
