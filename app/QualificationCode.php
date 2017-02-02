<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class QualificationCode extends Model
{
    use RevisionableTrait, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'type_id',
        'status',
    ];

    protected $attributes = [
        'status' => 'active',
    ];

    protected $searchable = [
        'code',
        'name'
    ];

    public function type()
    {
        return $this->belongsTo(QualifcationType::class, 'type_id');
    }

    public function logs()
    {
        return $this->morphMany(UserHistory::class, 'actionable');
    }

    public function getFullNameAttribute()
    {
        return sprintf('%s - %s', $this->code, $this->name);
    }

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
}
