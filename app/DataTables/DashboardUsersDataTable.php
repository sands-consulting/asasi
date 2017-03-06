<?php

namespace App\DataTables;

use App\User;

class DashboardUsersDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('last_activity',function($user) {
                if ($user->latestLog) {
                    // dd($user->latestLog);
                    return $user->latestLog->created_at->diffForHumans();
                } else {
                    return trans('user-logs.views.tables.empty');
                }
            })
            ->editColumn('status',function($user) {
                return view('admin.dashboard._users_status', compact('user'));
            })
            ->make(true);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = User::with('latestLog');

        if($this->datatables->request->input('filter', null)) {
            if ($this->datatables->request->input('filter', []) != 'all') {
                $query->where('status', $this->datatables->request->input('filter', []));
            }
        }

        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->ajax('')
                    ->addColumn([
                        'data'       => 'last_activity',
                        'name'       => 'last_activity',
                        'title'      => 'Last Activity',
                        'orderable'  => false,
                        'searchable' => false,
                        'exportable' => false,
                    ])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
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
            // [
            //     'data'  => 'last_activity',
            //     'name'  => 'last_activity',
            //     'title' => trans('users.attributes.updated_at'),
            // ],
            [
                'data'  => 'status',
                'name'  => 'users.status',
                'title' => trans('users.attributes.status'),
            ]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'dashboarduser_dt_' . time();
    }

    protected function getBuilderParameters()
    {
        $data = parent::getBuilderParameters();
        $data['dom'] = '<"datatable-header"lf><"datatable-scroll"t><"datatable-footer"ip>';
        return $data;
    }
}
