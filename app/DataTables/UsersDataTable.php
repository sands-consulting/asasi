<?php

namespace App\DataTables;

use App\User;
use Yajra\Datatables\Services\DataTable;

class UsersDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function($user) {
                return view('admin.users._index_actions', compact('user'));
            })
            ->addColumn('roles', function($user) {
                return view('admin.users._index_roles', compact('user'));
            })
            ->editColumn('name', function($user) {
                return link_to_route('admin.users.show', $user->name, $user->id);
            })
            ->editColumn('status', function($user) {
                return view('admin.users._index_status', compact('user'));
            })
            ->make(true);
    }

    public function query()
    {
        $query = User::with('roles');

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
            'name',
            'email',
            'roles',
            'status',
        ];
    }

    protected function filename()
    {
        return 'userstables_' . time();
    }

    protected function getBuilderParameters()
    {
        return [
            'dom' => '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>'
        ];
    }
}
