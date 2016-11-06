<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

class Project extends Model
{
    use RevisionableTrait,
        Sluggable,
        SoftDeletes;

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'name',
        'desctiption',
        'contact_name',
        'contact_position',
        'contact_email',
        'contact_phone',
        'contact_fax',
        'cost',
        'notice_id',
        'organization_id',
        'vendor_id',
        'value',
        'status'
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

    /*
     * Relationship
     */

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
    
    public function allocations()
    {
        return $this->belongsToMany(Allocation::class);
    }

    public function notices()
    {
        return $this->belongsTo(Notice::class);
    }

        public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot(['position', 'status'])
            ->withTimestamps();
    }

    public function milestones()
    {
        return $this->hasMany(ProjectMilestone::class);
    }

    public function logs()
    {
        return $this->morphMany(UserLog::class, 'actionable');
    }

    /*
     * Mutators
     */
    
    // public function getCostAttribute($value)
    // {
    //     return number_format($value, '0', '.', ',');
    // }

    /*
     * Helpers
     */
    
    public static function options()
    {
        return static::lists('name', 'id');
    }

    public function managers()
    {
        return $this->users()->wherePivot('position', 'manager')->get();
    }
}