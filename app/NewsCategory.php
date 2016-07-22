<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsCategory extends Model
{
    use Sluggable, SoftDeletes;

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
}
