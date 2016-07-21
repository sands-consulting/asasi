<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'description',
        'link',
        'news_id',
        'status'
    ];

    protected $attributes = [
        'status' => 'active',
    ];

    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
