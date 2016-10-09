<?php

namespace App\DataTables;

use App\Role;

class RolesDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function($role) {
                return view('admin.roles._index_actions', compact('role'));
            })
            ->make(true);
    }

    public function query()
    {
        return $this->applyScopes(Role::query());
    }

    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->ajax('')
                    ->addAction(['width' => '80', 'class' => 'text-left'])
                    ->parameters($this->getBuilderParameters());
    }

    protected function getColumns()
    {
        return [
            [
                'data'  => 'display_name',
                'name'  => 'roles.display_name',
                'title' => trans('roles.attributes.display_name'),
            ],
            [
                'data'  => 'description',
                'name'  => 'roles.description',
                'title' => trans('roles.attributes.description'),
            ],
        ];
    }

    protected function filename()
    {
        return 'roles_dt_' . time();
    }
}
