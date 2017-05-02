<?php

namespace App;

use App\Traits\DateAccessor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class NoticeInvitation extends Model
{
    use RevisionableTrait,
        DateAccessor;

    protected $revisionCreationsEnabled = true;

    protected $dates = [
        'sent_at'
    ];

    protected $fillable = [
        'notice_id',
        'vendor_id',
        'sent_at'
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
