<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class ProjectMilestone extends Model
{
    use RevisionableTrait,
        Sluggable,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'name',
        'slug',
        'desctiption',
        'baseline_start',
        'baseline_end',
        'duration',
        'actual_start',
        'actual_end',
        'actual_duration',
        'payment_milestone',
        'project_id',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $attributes = [
        'status' => 'active',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function scopeLatest($query, $limit)
    {
        return $query->orderBy('updated_at', 'desc')
            ->get()
            ->take($limit);
    }

    /*
     * Relationship
     */

    public function project()
    {
        return $this->belongsTo(ProjectMilestone::class);
    }

    public function logs()
    {
        return $this->morphMany(UserLog::class, 'actionable');
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
     * Mutators
     */
    
    public function getCostAttribute($value)
    {
        return number_format($value, '0', '.', ',');
    }
}
