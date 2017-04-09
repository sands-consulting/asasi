<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class TransactionLine extends Model
{
    use RevisionableTrait,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'description',
        'price',
        'quantity',
        'sub_total',
        'tax_code',
        'tax_rate',
        'tax',
        'total',
        'item_type',
        'item_id',
        'tax_id',
        'transaction_id'
    ];

    protected $hidden = [
    ];

    protected $attributes = [
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function item()
    {
        return $this->morphTo();
    }

    public function taxCode()
    {
        return $this->belongsTo(TaxCode::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($line)
        {
            $line->tax_code     = $line->taxCode->code;
            $line->tax_rate     = $line->taxCode->rate;
            $line->sub_total    = $line->quantity * $line->price;
            $line->tax          = $line->tax_rate * $line->sub_total / 100;
            $line->total        = $line->sub_total + $line->tax;
        });
    }
}
