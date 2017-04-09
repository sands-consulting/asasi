<?php

namespace App\DataTables;

use App\Package;

class PackagesDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function($package) {
                return view('admin.packages._index_actions', compact('package'));
            })
            ->editColumn('status', function($package) {
                return view('admin.packages._index_status', compact('package'));
            })
            ->make(true);
    }

    public function query()
    {
        $query = Package::whereNotNull('name');

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
                'data' => 'name',
                'name' => 'name',
                'title' => trans('packages.attributes.name')
            ],
            [
                'data' => 'fee',
                'name' => 'fee',
                'title' => trans('packages.attributes.fee')
            ],
            [
                'data' => 'status',
                'name' => 'status',
                'title' => trans('packages.attributes.status')
            ],
        ];
    }

    protected function filename()
    {
        return 'packages_dt_' . time();
    }

    protected function getBuilderParameters()
    {
        $data = parent::getBuilderParameters();
        $data['dom'] = '<"datatable-header"l><"datatable-scroll"t><"datatable-footer"ip>';
        return $data;
    }
}
