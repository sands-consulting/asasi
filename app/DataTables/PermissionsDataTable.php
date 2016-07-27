<?php

namespace App\DataTables;

use App\Permission;

class PermissionsDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('roles', function($permission) {
                return view('admin.permissions._index_roles', compact('permission'));
            })
            ->editColumn('group', function($permission) {
                return str_titleize($permission->group);
            })
            ->make(true);
    }

    public function query()
    {
        $query = Permission::with('roles');

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
                    ->parameters($this->getBuilderParameters());
    }

    protected function getColumns()
    {
        return [
            [
                'data'  => 'group',
                'name'  => 'permissions.group',
                'title' => trans('permissions.attributes.group'),
            ],
            [
                'data'  => 'description',
                'name'  => 'permissions.description',
                'title' => trans('permissions.attributes.permission'),
            ],
            [
                'data'      => 'roles',
                'name'      => 'roles',
                'title'     => trans('permissions.attributes.roles'),
                'orderable'     => false,
                'searchable'    => false
            ]
        ];
    }

    protected function filename()
    {
        return 'roles_dt_' . time();
    }


    protected function getBuilderParameters()
    {
        $data = parent::getBuilderParameters();
        $data['dom'] = '<"datatable-header"l><"datatable-scroll"t><"datatable-footer"ip>';
        return $data;
    }
}
