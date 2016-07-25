<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use Sluggable, SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'category_id',
        'status'
    ];

    protected $attributes = [
        'status' => 'draft',
    ];

    public function banner()
    {
        return $this->hasOne(Banner::class);
    }

    public function category()
    {
        return $this->belongsTo(NewsCategory::class, 'category_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getRouteKeyName()
    {   
        return 'slug';
    }
}