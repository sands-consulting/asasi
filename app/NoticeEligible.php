<?php

namespace App;

use App\Traits\DateAccessor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class NoticeEligible extends Model
{
    use RevisionableTrait,
        DateAccessor;

    protected $revisionCreationsEnabled = true;

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
