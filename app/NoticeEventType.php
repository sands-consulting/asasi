<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class NoticeEventType extends Model
{
    use RevisionableTrait,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'name',
        'status',
    ];

    protected $attributes = [
        'status' => 'active'
    ];

    public function events()
    {
        return $this->hasMany(NoticeEvent::class);
    }

    public function scopeActive($query)
    {
        return $query->whereStatus('active');
    }
    
    public static function options()
    {
        return static::active()->pluck('name', 'id');
    }
}
