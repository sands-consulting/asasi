<?php

namespace App\DataTables;

use App\User;

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
                $string = link_to_route('admin.users.show', $user->name, $user->id);

                if(count($user->vendors) > 0) {
                    $string .= '<br><small>' . $user->vendors[0]->name . '</small>';
                }

                return $string;
            })
            ->editColumn('status', function($user) {
                return view('admin.users._index_status', compact('user'));
            })
            ->make(true);
    }

    public function query()
    {
        $query = User::with('roles', 'vendors');

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
                'name'  => 'users.name',
                'title' => trans('users.attributes.name'),
            ],
            [
                'data'  => 'email',
                'name'  => 'users.email',
                'title' => trans('users.attributes.email'),
            ],
            [
                'data'          => 'roles',
                'name'          => 'roles',
                'searchable'    => false,
                'orderable'     => false,
                'title'         => trans('users.attributes.roles'),
            ],
            [
                'data'  => 'status',
                'name'  => 'status',
                'title' => trans('users.attributes.status'),
            ]
        ];
    }

    protected function filename()
    {
        return 'users_dt_' . time();
    }


    protected function getBuilderParameters()
    {
        $data = parent::getBuilderParameters();
        $data['dom'] = '<"datatable-header"l><"datatable-scroll"t><"datatable-footer"ip>';
        return $data;
    }
}
