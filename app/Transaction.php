<?php

namespace App;

use App\Traits\DateAccessor;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class Transaction extends Model
{
    use RevisionableTrait,
        DateAccessor,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'transaction_number',
        'invoice_number',
        'sub_total',
        'tax',
        'total',
        'payee_type',
        'payee_id',
        'user_id',
        'gateway_id',
        'status',
        'paid_at'
    ];

    protected $hidden = [
        //
    ];

    protected $attributes = [
        'status' => 'pending'
    ];

    protected $dates = [
        'paid_at'
    ];

    public function histories()
    {
        return $this->morphMany(UserHistory::class, 'actionable');
    }

    public function lines()
    {
        return $this->hasMany(TransactionLine::class);
    }

    public function payer()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gateway()
    {
        return $this->belongsTo(PaymentGateway::class, 'gateway_id');
    }

    public function calculate()
    {
        $this->sub_total = $this->lines()->sum('sub_total');
        $this->tax       = $this->lines()->sum('tax');
        $this->total     = $this->lines()->sum('total');

        return $this;
    }

    public function paid()
    {
        $running = Setting::whereKey('invoice.' . date('Y'))->first();

        if($running)
        {
            $running->update(['value' => (int) $running->value + 1]);
        }
        else
        {
            $running = Setting::create(['key' => 'invoice.' . date('Y'), 'value' => 1]);
        }

        $this->invoice_number   = sprintf('%d-%08d', date('Y'), $running->value);
        $this->status           = 'paid';
        $this->paid_at          = Carbon::now();

        return $this;
    }

    public function scopePending($query)
    {
        return $query->whereStatus('pending');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($transaction)
        {
            $transaction->transaction_number    = strtoupper(str_random(12));
            $transaction->sub_total             = 0.00;
            $transaction->tax                   = 0.00;
            $transaction->total                 = 0.00;
        });
    }
}
