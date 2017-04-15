<?php

namespace App;

use App\Traits\DateAccessor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class NoticePurchase extends Model
{
    use RevisionableTrait,
        DateAccessor;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'notice_id',
        'vendor_id'
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
        return $this->hasOne(Submission::class, 'purchase_id');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($purchase) {
            $purchase->number = strtoupper(str_random(8));
        });
    }
}
