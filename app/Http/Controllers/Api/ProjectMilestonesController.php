<?php

namespace App\Http\Controllers\Api;

use App\Project;
use App\Http\Controllers\Controller;

class ProjectMilestonesController extends Controller
{
    public function getGanttTasks(Project $project)
    {
        $tasks = $project->ganttTasks->map(function ($task, $key) {
            $data['id'] = "{$task->id}";
            $data['start'] = $task->start->toDateTimeString();
            $data['end'] = $task->end->toDatetimeString();
            $data['name'] = $task->name;
            $data['progress'] = $task->progress;

            $data['dependencies'] = ($task->links->count() > 0) ? $task->links->implode('dependency_id', ',') : false;
            return $data;
        });

        return response()->json($tasks);
    }
}
