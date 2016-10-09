<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class News extends Model
{
    use RevisionableTrait,
        Sluggable,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'title',
        'content',
        'category_id',
        'organization_id',
        'status'
    ];

    protected $attributes = [
        'status' => 'draft',
    ];

    public function logs()
    {
        return $this->morphMany(UserLog::class, 'actionable');
    }

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

    public function canPublish()
    {
        return $this->status != 'published';
    }

    public function canUnpublish()
    {
        return $this->status != 'not-published';
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

    public static function boot()
    {
        parent::boot();
    }
}
