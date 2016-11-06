<?php

namespace App;

use App\Libraries\Traits\DateAccessorTrait;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use DateAccessorTrait;

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

    public static function boot()
    {
        parent::boot();
    }
}