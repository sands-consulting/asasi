<?php

namespace App\DataTables;

use App\Notice;

class DashboardNoticesDataTable extends DataTable
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
            ->editColumn('number', function ($notice) {
                return link_to_route('admin.notices.show', $notice->number, $notice->id)
                    . '<br>' . $notice->name;
            })
            ->editColumn('published_at', function ($notice) {
                return $notice->published_at->formatDateFromSetting();
            })
            ->editColumn('expired_at', function ($notice) {
                return $notice->expired_at->formatDateFromSetting();
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
        $query = Notice::query();
        $filter = $this->datatables->request->input('filter', null);

        if(!is_null($filter)) {
            if ($filter != 'all') {
                $query->where('status', $filter);
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
                'data'  => 'number',
                'name'  => 'notices.number',
                'title' => trans('notices.attributes.name'),
            ],
            [
                'data'  => 'published_at',
                'name'  => 'notices.published_at',
                'title' => trans('notices.attributes.published_at'),
            ],
            [
                'data'  => 'expired_at',
                'name'  => 'notices.expired_at',
                'title' => trans('notices.attributes.expired_at'),
            ],
            [
                'data'  => 'status',
                'name'  => 'notices.status',
                'title' => trans('notices.attributes.status'),
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
