<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class File extends Model
{
    use RevisionableTrait,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
    	'name',
    	'display_name',
    	'description',
    	'status'
    ];

    protected $attributes = [
    	'status' => 'active'
    ];

    public function rules()
    {
    	return $this->hasMany(FileRule::class);
    }
}
