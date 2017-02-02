<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class Allocation extends Model
{
    use RevisionableTrait,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'name',
        'value',
        'type_id',
        'organization_id',
        'status'
    ];

    protected $attributes = [
        'status' => 'active',
    ];

    public function type()
    {
        return $this->belongsTo(AllocationType::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function logs()
    {
        return $this->morphMany(UserHistory::class, 'actionable');
    }

    public function canActivate()
    {
        return $this->status != 'active';
    }

    public function canDeactivate()
    {
        return $this->status != 'inactive';
    }

    /*
     * Relationship
     */
    
    public function notices()
    {
        return $this->belongsToMany(Notice::class)
            ->withPivot('amount')
            ->withTimestamps();
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    /*
     * Mutators
     */
    

    /*
     * Helpers
     */
    
    public static function options()
    {
        return static::pluck('name', 'id');
    }
}
