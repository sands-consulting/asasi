<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class FileType extends Model
{
    use RevisionableTrait,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
    	'name',
    	'display_name',
    	'description',
        'item_type',
        'item_id',
    	'status'
    ];

    protected $attributes = [
    	'status' => 'active'
    ];

    public static function getOptions($label='display_name')
    {
        return self::pluck('display_name', 'id')->toArray();
    }
}
