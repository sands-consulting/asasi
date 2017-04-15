<?php

namespace App\Http\Controllers\Admin;

use App\GanttTask;
use App\GanttLink;
use App\Notice;
use App\Project;
use App\ProjectMilestone;
use App\Organization;
use App\DataTables\ProjectMilestoneDataTable;
use App\DataTables\RevisionsDataTable;
use App\DataTables\UserHistoriesDataTable;
use App\Http\Requests\ProjectMilestoneRequest;
use App\Services\ProjectMilestonesService;
use App\Services\UserHistoriesService;
use Illuminate\Http\Request;
use Dhtmlx\Connector\GanttConnector;

class ProjectMilestonesController extends Controller
{
    public function index(Request $request, Project $project)
    {
        return view('admin.project-milestones.index', compact('project'));
    }

    public function show(Project $project, ProjectMilestone $milestone)
    {
        return view('admin.project-milestones.show', compact('milestone'));
    }

    public function create(Request $request)
    {
        return view('admin.project-milestones.create', ['milestone' => new ProjectMilestone]);
    }

    public function createByNotice(Request $request)
    {
        $input = $request->only('notice_id');
        $milestone = Notice::find($input['notice_id']);
        return view('admin.project-milestones.create', ['milestone' => $milestone]);
    }

    public function store(ProjectMilestoneRequest $request)
    {
        $inputs = $request->only('name', 'value', 'status', 'type_id');

        if ($request->user()->hasPermission('milestone:organization')) {
            $inputs['organization_id'] = $request->user()->organizations()->first()->id;
        } else {
            $inputs['organization_id'] = $request->input('organization_id', Organization::first()->id);
        }

        $milestone = ProjectMilestonesService::create(new ProjectMilestone, $inputs);
        UserHistoriesService::log($request->user(), 'create', $milestone, $request->getClientIp());
        return redirect()
            ->route('admin.project-milestones.show', $milestone->id)
            ->with('notice', trans('milestones.notices.created', ['name' => $milestone->name]));
    }

    public function edit(ProjectMilestone $milestone)
    {
        return view('admin.project-milestones.edit', compact('milestone'));
    }

    public function update(ProjectMilestoneRequest $request, ProjectMilestone $milestone)
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
            'status'
        );

        if ($request->user()->hasPermission('milestone:organization')) {
            $inputs['organization_id'] = $request->user()->organizations()->first()->id;
        } else {
            $inputs['organization_id'] = $request->input('organization_id', Organization::first()->id);
        }

        ProjectMilestonesService::update($milestone, $inputs);

        $managers = [];
        if (count($inputs['managers']) > 0) {
            foreach ($inputs['managers'] as $manager) {
                $managers[$manager] = [
                    'position' => 'manager',
                    'status'   => 'active',
                ];
            }
        }
        $milestone->users()->sync($managers);

        UserHistoriesService::log($request->user(), 'update', $milestone, $request->getClientIp());
        return redirect()
            ->route('admin.project-milestones.show', $milestone->id)
            ->with('notice', trans('milestones.notices.updated', ['number' => $milestone->number]));
    }

    public function destroy(Request $request, ProjectMilestone $milestone)
    {
        ProjectMilestonesService::delete($milestone);
        UserHistoriesService::log($request->user(), 'delete', $milestone, $request->getClientIp());
        return redirect()
            ->route('admin.project-milestones.index')
            ->with('notice', trans('milestones.notices.deleted', ['name' => $milestone->name]));
    }

    public function histories(ProjectMilestone $milestone, UserHistoriesDataTable $table)
    {
        $table->setActionable($milestone);
        return $table->render('admin.project-milestones.histories', compact('milestone'));
    }

    public function revisions(ProjectMilestone $milestone, RevisionsDataTable $table)
    {
        $table->setRevisionable($milestone);
        return $table->render('admin.project-milestones.revisions', compact('milestone'));
    }

    public function ganttData(Request $request, Project $project)
    {
        if ($request->isMethod('post')) {
            return $request->all();
        }

        $ganttLink = GanttLink::where('project_id', $project->id)->get();
        $ganttTask = GanttTask::where('project_id', $project->id)->get();

        $ganttLink = $ganttLink->count() > 0 ? $ganttLink : new GanttLink();
        $ganttTask = $ganttTask->count() > 0 ? $ganttTask : new GanttTask();

        $connector = new GanttConnector(null, "PHPLaravel");
        $connector->render_links($ganttLink,
            "id",
            "source,target,type, project_id",
            false,
            $project->id
        );

        $connector->render_table($ganttTask,
            "id",
            "start_date, duration, title, progress, parent, project_id",
            false,
            $project->id
        );
    }

}
