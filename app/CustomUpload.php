<?php

namespace App;

use Auth;
use Sands\Uploadable\Upload;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomUpload extends Upload
{
    use SoftDeletes;

    protected $table = 'uploads';
    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'uploadable_type',
        'uploadable_id',
        'type',
        'name',
        'mime_type',
        'url',
        'path',
        'user_id',
        'status',
    ];

    protected $attributes = [
        'status' => 'active'
    ];

    public function logs()
    {
        return $this->morphMany(UserLog::class, 'actionable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
