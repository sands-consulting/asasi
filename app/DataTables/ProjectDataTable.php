<?php

namespace App\DataTables;

use App\Project;

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
                $link = "<small>" . $project->number . "</small>";
                $link .= "<br>" . link_to_route('admin.projects.show', $project->name, $project->id) ." ";
                return $link;
            })
            ->editColumn('projects.status', function($project) {
                return trans('statuses.' . $project->status);
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
        $query = Project::with('organization');
        $query = $query->leftJoin('organizations', 'projects.organization_id', '=', 'organizations.id');
        $query = $query->select('projects.*', 'organizations.name as organization_name');

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
            ]
        ];

        if(!$this->user->hasPermission('project:organization'))
        {
            $columns[] = [
                'data'  => 'organization_name',
                'name'  => 'organizations.name',
                'title' => trans('projects.attributes.organization')
            ];
        }

        $columns[] = [
            'data'  => 'projects.status',
            'name'  => 'projects.status',
            'title' => trans('projects.attributes.status'),
        ];
        // $columns[] = [
        //     'data' => 'created_at',
        //     'name' => 'projects.created_at',
        //     'title' => trans('projects.attributes.created_at')
        // ];
        
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
