<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class AllocationType extends Model
{
    use RevisionableTrait,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'name',
        'status'
    ];

    protected $attributes = [
        'status' => 'active',
    ];

    public function allocations()
    {
        return $this->hasMany(Allocation::class, 'type_id');
    }

    public function logs()
    {
        return $this->morphMany(UserLog::class, 'actionable');
    }
}
