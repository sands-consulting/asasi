<?php

namespace App;

use App\Traits\DateAccessor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class NoticeEligible extends Model
{
    use RevisionableTrait,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $attributes = [
        'exception' => false
    ];

    protected $dates = [
        'notified_at'
    ];

    protected $fillable = [
        'exception',
        'remarks',
        'notice_id',
        'vendor_id',
        'notified_at'
    ];

    public function notice()
    {
        return $this->belongsTo(Notice::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
