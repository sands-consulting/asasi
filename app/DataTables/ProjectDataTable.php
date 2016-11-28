<?php

namespace App\DataTables;

use App\Project;
use Gravatar;

class ProjectDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function($project) {
                return view('admin.projects._index_actions', compact('project'));
            })
            ->editColumn('projects.name', function($project) {
                $link = "<small>" . $project->number .
                        "<br>" . link_to_route('admin.projects.show', str_limit($project->name, 100), $project->id, ['title' => $project->name]) . "</small>";
                return $link;
            })
            ->editColumn('project_progress', function($project) {
                return view('admin.projects._index_progress', compact('project'));
            })
            ->editColumn('project_status', function($project) {
                return view('admin.projects._index_status', compact('project'));
            })
            ->editColumn('project_manager', function($project) {
                return view('admin.projects._index_managers', compact('project'));
            })
            ->editColumn('projects.created_at', function($project) {
                return $project->created_at->format('d/m/Y H:i:s');
            })
            ->editColumn('organization_name', function($project) {
                return $project->organization->name;
            })
            ->make(true);
    }

    public function query()
    {
        $query = Project::with(['organization', 'vendor', 'users']);
        $query = $query->leftJoin('organizations', 'projects.organization_id', '=', 'organizations.id');
        $query = $query->leftJoin('vendors', 'projects.vendor_id', '=', 'vendors.id');
        $query = $query->select(
            'projects.*', 
            'projects.status as project_status',
            'projects.progress as project_progress',
            'organizations.name as organization_name',
            'projects.id as project_manager',
            'vendors.name as vendor_name'
        );

        if($this->datatables->request->input('q', null))
        {
            $query->search($this->datatables->request->input('q', []));
        }

        return $this->applyScopes($query);
    }

    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->ajax('')
            ->addAction(['width' => '80', 'class' => 'text-center'])
            ->parameters($this->getBuilderParameters());
    }

    protected function getColumns()
    {
        $columns = [
            [
                'data'  => 'projects.name',
                'name'  => 'projects.name',
                'title' => trans('projects.attributes.name'),
                'sWidth' => '25%',
            ]
        ];

        if(!$this->user->hasPermission('project:organization'))
        {
            $columns[] = [
                'data'  => 'vendor_name',
                'name'  => 'vendors.name',
                'title' => trans('projects.attributes.vendor')
            ];
        }

        $columns[] = [
            'data'  => 'project_progress',
            'name'  => 'project_progress',
            'title' => trans('projects.attributes.progress'),
            'sWidth' => '15%'
        ];

        $columns[] = [
            'data'  => 'project_manager',
            'name'  => 'project_manager',
            'title' => trans('projects.attributes.managers'),
            'sClass' => 'text-center'
        ];

        $columns[] = [
            'data'  => 'project_status',
            'name'  => 'project_status',
            'title' => trans('projects.attributes.status'),
        ];

        $columns[] = [
            'data' => 'projects.created_at',
            'name' => 'projects.created_at',
            'title' => trans('projects.attributes.created_at')
        ];

        return $columns;
    }

    protected function filename()
    {
        return 'projects_dt_' . time();
    }
}
