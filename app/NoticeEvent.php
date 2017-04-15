<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;
use App\Traits\DateAccessor;

class NoticeEvent extends Model
{
    use RevisionableTrait,
        DateAccessor,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'name',
        'schedule_at',
        'location',
        'required',
        'notice_id',
        'notice_event_type_id',
        'status',
    ];

    protected $dates = [
        'schedule_at'
    ];

    public function notice()
    {
        return $this->belongsTo(Notice::class);
    }

    public function activities()
    {
        return $this->morphMany(NoticeActivity::class, 'activitable');
    }

    public function type()
    {
        return $this->belongsTo(NoticeEventType::class, 'type_id');
    }

    public static function options()
    {
        return static::pluck('name', 'id');
    }
}
