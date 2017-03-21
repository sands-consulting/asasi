<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class TaxCode extends Model
{
    use RevisionableTrait,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'name',
        'code',
        'rate',
        'status'
    ];

    protected $attributes = [
        'status' => 'active',
    ];

    public function getLabelAttribute()
    {
        return sprintf('%s - %.2f', $this->code, $this->rate) . '%';
    }

    public static function options($label='label')
    {
        return self::get()->pluck($label, 'id')->toArray();
    }
}