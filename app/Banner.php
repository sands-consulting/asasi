<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class Banner extends Model
{
    use RevisionableTrait,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'description',
        'link',
        'news_id',
        'status'
    ];

    protected $attributes = [
        'status' => 'active',
    ];

    public function logs()
    {
        return $this->morphMany(UserLog::class, 'actionable');
    }

    public function news()
    {
        return $this->belongsTo(News::class);
    }

    public static function boot()
    {
        parent::boot();
    }
}