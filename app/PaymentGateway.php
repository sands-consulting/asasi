<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class PaymentGateway extends Model
{
    use RevisionableTrait,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'name',
        'label',
        'type',
        'prefix',
        'status'
    ];

    protected $attributes = [
        'status' => 'active',
    ];

    public function logs()
    {
        return $this->morphMany(UserHistory::class, 'actionable');
    }

    public function organizations()
    {
        return $this->belongsToMany(Organization::class);
    }

    public function settings()
    {
        return $this->morphMany(Setting::class, 'item');
    }

    public static function getOptions($label='name')
    {
        return static::pluck($label, 'id')->toArray();
    }

    public static function boot()
    {
        parent::boot();
    }
}
