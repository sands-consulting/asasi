<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GanttTask extends Model
{
    protected $table = "gantt_tasks";
    public $primaryKey = "id";

    /*
     * Relationship
     */
    
    public function ganttLinks()
    {
        return $this->hasMany(GanttLink::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
