<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class NoticeAward extends Model
{
    use RevisionableTrait,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'price',
        'period'
    ];

    public function notice()
    {
        return $this->belongsTo(Notice::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function submission()
    {
        return $this->belongsTo(Vendor::class);
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function($award) {
            $award->vendor_id = $award->submission->vendor_id;
        });
    }
}
