<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GanttDependency extends Model
{
    protected $fillable = [
        'task_id',
        'dependency_id',
    ];

    /*
     * Relationship
     */

    public function task()
    {
        return $this->belongsTo(GanttTask::class);
    }
}
