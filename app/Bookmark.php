<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class Bookmark extends Model
{
    use RevisionableTrait,
        SoftDeletes;

    protected $fillable = [
        'bookmarkable_type',
        'bookmarkable_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bookmarkable()
    {
        return $this->morphTo();
    }
}
