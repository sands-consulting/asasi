<?php namespace App;

use App\Traits\DateAccessor;
use App\Traits\Searchable;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Venturecraft\Revisionable\RevisionableTrait;

class Subscription extends Authenticatable
{
    use RevisionableTrait,
        Searchable,
        SoftDeletes,
        DateAccessor;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'number',
        'start_at',
        'end_at',
        'package_id',
        'user_id',
        'subscriber_type',
        'subscriber_id',
        'status'
    ];

    protected $attributes = [
        'status' => 'pending'
    ];

    protected $searchable = [
        'number',
    ];

    protected $sortable = [
        'started_at',
        'expired_at',
        'status'
    ];

    protected $dates = [
        'start_at',
        'end_at'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeValid($query)
    {
        return $queyr->whereIn('status', ['active', 'expired']);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function subscriber()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactionLine()
    {
        return $this->morphOne(TransactionLine::class, 'item');
    }

    public function getExpiringAttribute()
    {
        $compare = $this->end_at->subMonths(3);
        return $compare->freshTimestamp()->gte($compare);
    }

    public function getExpiredAttribute()
    {
        return $compare->freshTimestamp()->gt($this->end_at);
    }

    public function getTransactionLineDescriptionAttribute()
    {
        return sprintf("%s\n%s - %s (%s)\n%s", $this->package->name, $this->start_at->format('d/m/Y'), $this->end_at->format('d/m/Y'), $this->package->validity, $this->number);
    }

    public function paid()
    {
        $this->subscriber->update(['status' => 'active']);
        $this->status = 'active';

        return $this;
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($subscription)
        {
            switch ($subscription->package->validity_type) {
                case 'days':
                    $endDate    = $subscription->start_at->copy()->addDays($subscription->package->validity_quantity);
                    break;

                case 'months':
                    $endDate    = $subscription->start_at->copy()->addMonths($subscription->package->validity_quantity);
                    break;

                case 'years':
                    $endDate    = $subscription->start_at->copy()->addYears($subscription->package->validity_quantity);
                    break;

                default:
                    break;
            }

            $subscription->end_at   = $endDate->endOfDay();
            $subscription->number   = strtoupper(strtoupper(str_random(8)));
        });
    }
}
