<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GanttTask extends Model
{
    protected $dates = [
        'start',
        'end',
    ];

    /*
     * Relationship
     */

    public function links()
    {
        return $this->hasMany(GanttDependency::class, 'task_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
