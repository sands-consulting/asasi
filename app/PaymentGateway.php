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
        'status',
        'default'
    ];

    protected $attributes = [
        'status' => 'active',
    ];

    protected $searchable = [
        'name',
        'label',
        'type',
        'prefix',
        'status'
    ];

    public static $types = [
        'billplz',
        'ebpg',
        'fpx'
    ];

    /*
     * Search scopes
     */

    public function scopeSearch($query, $queries = [])
    {
        if (isset($queries['keywords']) && !empty($queries['keywords'])) {
            $keywords = $queries['keywords'];
            $query->where(function($query) use($keywords) {
                foreach ($this->searchable as $column) {
                    $query->orWhere("{$this->getTable()}.{$column}", 'LIKE', "%$keywords%");
                }
            });
            unset($queries['keywords']);
        }

        foreach ($queries as $key => $value) {
            if (empty($value)) {
                continue;
            }
            $query->where("{$this->getTable()}.{$key}", $value);
        }
    }

    /* Relationships */

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

    public static function getOptions($label='label')
    {
        return static::pluck($label, 'id')->toArray();
    }
}
