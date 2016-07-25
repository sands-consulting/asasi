<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class NewsCategory extends Model
{
    use RevisionableTrait,
        Sluggable,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'name',
        'status'
    ];

    protected $attributes = [
        'status' => 'active',
    ];

    public function news()
    {
        return $this->hasMany(News::class, 'category_id');
    }

    public static function boot()
    {
        parent::boot();
    }
}
