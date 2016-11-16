<?php

namespace App\DataTables;

use App\Vendor;
use Yajra\Datatables\Services\DataTable;

class DashboardVendorsDataTable extends DataTable
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
        $query = Vendor::query();
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
                'data'  => 'name',
                'name'  => 'vendors.name',
                'title' => trans('vendors.attributes.name'),
            ],
            [
                'data'  => 'contact_email',
                'name'  => 'vendors.contact_email',
                'title' => trans('vendors.attributes.contact_email'),
            ],
            [
                'data'  => 'status',
                'name'  => 'vendors.status',
                'title' => trans('vendors.attributes.status'),
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
