<?php

namespace App\Http\Controllers\Admin;

use App\Notice;
use App\Project;
use App\Organization;
use App\DataTables\ProjectDataTable;
use App\DataTables\ProjectNoticeDataTable;
use App\DataTables\RevisionsDataTable;
use App\DataTables\UserHistoriesDataTable;
use App\Http\Requests\ProjectRequest;
use App\Services\ProjectService;
use App\Services\UserHistoryService;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index(Request $request, ProjectDataTable $table)
    {
        $table->setUser($request->user());
        return $table->render('admin.projects.index');
    }

    public function show(Project $project)
    {
        $ganttTasks = $project->ganttTasks()->orderBy('id', 'desc')->take(5)->get();
        return view('admin.projects.show', compact('project', 'ganttTasks'));
    }

    public function create(Request $request)
    {
        return view('admin.projects.create', ['project' => new Project]);
    }

    public function createByNotice(Request $request)
    {
        $input = $request->only('notice_id');
        $project = Notice::find($input['notice_id']);
        return view('admin.projects.create', ['project' => $project]);
    }

    public function store(ProjectRequest $request)
    {
        $inputs = $request->only('name', 'value', 'status', 'type_id');

        if($request->user()->hasPermission('project:organization')) {
            $inputs['organization_id'] = $request->user()->organizations()->first()->id;
        } else {
            $inputs['organization_id'] = $request->input('organization_id', Organization::first()->id);
        }

        $project = ProjectService::create(new Project, $inputs);
        UserHistoryService::log($request->user(), 'create', $project, $request->getClientIp());
        return redirect()
            ->route('admin.projects.show', $project->id)
            ->with('notice', trans('projects.notices.created', ['name' => $project->name]));
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $inputs = $request->only(
            'organization_id',
            'name',
            'number',
            'description',
            'contact_name', 
            'contact_position', 
            'contact_phone', 
            'contact_fax', 
            'contact_email', 
            'managers', 
            'vendor_id', 
            'cost', 
            'progress',
            'notification',
            'status'
        );

        if($request->user()->hasPermission('project:organization'))
        {
            $inputs['organization_id'] = $request->user()->organizations()->first()->id;
        }
        else
        {
            $inputs['organization_id'] = $request->input('organization_id', Organization::first()->id);
        }

        ProjectService::update($project, $inputs);

        $managers = [];
        if (count($inputs['managers']) > 0) {
            foreach ($inputs['managers'] as $manager) {
                $managers[$manager] = [
                    'position' => 'manager',
                    'status' => 'active'
                ];
            }
        }
        $project->users()->sync($managers);

        UserHistoryService::log($request->user(), 'update', $project, $request->getClientIp());
        return redirect()
            ->route('admin.projects.show', $project->id)
            ->with('notice', trans('projects.notices.updated', ['number' => $project->number]));
    }

    public function destroy(Project $project)
    {
        ProjectService::delete($project);
        UserHistoryService::log($request->user(), 'delete', $project, $request->getClientIp());
        return redirect()
            ->route('admin.projects.index')
            ->with('notice', trans('projects.notices.deleted', ['name' => $project->name]));
    }

    public function histories(Project $project, UserHistoriesDataTable $table)
    {
        $table->setActionable($project);
        return $table->render('admin.projects.histories', compact('project'));
    }

    public function revisions(Project $project, RevisionsDataTable $table)
    {
        $table->setRevisionable($project);
        return $table->render('admin.projects.revisions', compact('project'));
    }
}
