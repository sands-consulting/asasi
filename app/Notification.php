<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class Notification extends Model
{
    use RevisionableTrait,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'content',
        'link',
        'item_type',
        'item_id',
        'user_id',
        'status'
    ];

    protected $attributes = [
        'status' => 'unread',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'read_at'
    ];

    /*
     * Scope
     */
    
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /*
     * Relationship
     */
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->morphTo();
    }

    public function getUnreadAttribute()
    {
        return $this->status == 'unread';
    }

    public function getReadAttribute()
    {
        return $this->status == 'read';
    }

    public function read()
    {
        if($this->status == 'unread')
        {
            $this->update(['status' => 'read', 'read_at' => Carbon::now()]);
        }
    }
}