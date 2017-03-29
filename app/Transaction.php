<?php

namespace App;

//use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;
use App\Traits\DateAccessor;

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
        'user_id'
    ];

    protected $hidden = [
    ];

    protected $attributes = [
        'status' => 'new'
    ];

    protected $searchable = [
    ];

    protected $sortable = [
    ];

    /*
     * Relationships
     */
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
}
