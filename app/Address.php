<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class Address extends Model
{
    use RevisionableTrait,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'line_one',
        'line_two',
        'postcode',
        'city_id',
        'state_id',
        'country_id'
    ];

    public function city()
    {
        return $this->belongsTo(Place::class, 'city_id');
    }

    public function state()
    {
        return $this->belongsTo(Place::class, 'state_id');
    }

    public function country()
    {
        return $this->belongsTo(Place::class, 'country_id');
    }

    public function item()
    {
        return $this->morphTo();
    }
}
