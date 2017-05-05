<?php

namespace App\Http\Controllers\Api;

use App\GanttTask;
use App\Http\Controllers\Controller;
use App\Project;
use Illuminate\Http\Request;

class ProjectMilestonesController extends Controller
{
    public function getGanttTasks(Project $project)
    {
        $tasks = $project->ganttTasks->map(function ($task, $key) {
            $data['id'] = "{$task->id}";
            $data['start'] = $task->start->toDateString();
            $data['end'] = $task->end->toDateString();
            $data['duration'] = $task->duration;
            $data['name'] = $task->name;
            $data['progress'] = $task->progress;
            $data['ratings'] = $task->ratings;
            $data['dependencies'] = ($task->links->count() > 0) ? $task->links->implode('dependency_id', ',') : false;
            return $data;
        });

        return response()->json($tasks);
    }

    public function updateTask(Request $request)
    {
        $task = GanttTask::find($request->get('id'));

        foreach ($request->get('data') as $key => $value) {
            $task->{$key} = $value;
        }

        $task->save();
        return $task;
    }

    public function updateRating(Request $request)
    {
        $task = GanttTask::find($request->get('id'));
        $task->ratings = $request->get('ratings');
        $task->save();

        return $task;
    }
}
