<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class Upload extends Model
{

    use RevisionableTrait,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'name',
        'token',
        'path',
        'url',
        'type',
        'size',
        'mime_type',
        'uploadable_type',
        'uploadable_id',
        'user_id',
        'status'
    ];

    protected $attributes = [
        'status' => 'active'
    ];

    public function uploadable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
