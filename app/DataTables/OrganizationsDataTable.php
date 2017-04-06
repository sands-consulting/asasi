<?php

namespace App\DataTables;

use App\Organization;

class OrganizationsDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function($organization) {
                return view('admin.organizations._index_actions', compact('organization'));
            })
            ->editColumn('status', function($organization) {
                return view('admin.organizations._index_status', compact('organization'));
            })
            ->addColumn('parent_short_name', function($organization) {
                return view('admin.organizations._index_parent', compact('organization'));
            })
            ->make(true);
    }

    public function query()
    {
        $query = Organization::leftJoin('organizations as parent', 'organizations.parent_id', '=', 'parent.id')->select('organizations.*');

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
        return [
            [
                'data'  => 'name',
                'name'  => 'organizations.name',
                'title' => trans('organizations.attributes.name'),
            ],
            [
                'data'  => 'short_name',
                'name'  => 'organizations.short_name',
                'title' => trans('organizations.attributes.short_name'),
            ],
            [
                'data'  => 'parent_short_name',
                'name'  => 'parent.short_name',
                'title' => trans('organizations.attributes.parent')
            ],
            [
                'data'  => 'status',
                'name'  => 'organizations.status',
                'title' => trans('organizations.attributes.status'),
            ]
        ];
    }

    protected function filename()
    {
        return 'organizations_dt_' . time();
    }


    protected function getBuilderParameters()
    {
        $data = parent::getBuilderParameters();
        $data['dom'] = '<"datatable-header"l><"datatable-scroll"t><"datatable-footer"ip>';
        return $data;
    }
}
