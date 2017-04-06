<?php

namespace App\DataTables\Portal;

use App\Project;

class VendorProjectsDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function($notice) {
                return view('vendors.projects.index.actions', compact('notice'));
            })
            ->editColumn('name', function($notice) {
                return view('notices.index.name', compact('notice'));
            })
            ->make(true);
    }

    public function query()
    {
        $query = Project::where('vendor_id', $this->vendor_id);

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
                'data' => 'name',
                'name' => 'name',
                'title' => trans('projects.attributes.name'),
                'width' => '40%'
            ],
            [
                'data' => 'code',
                'name' => 'code',
                'title' => 'Code',
                'width' => '15%'
            ],
            [
                'data' => 'cost',
                'name' => 'cost',
                'title' => trans('projects.attributes.costs'),
                'width' => '15%'
            ],
        ];
    }

    protected function filename()
    {
        return 'notices_dt_' . time();
    }

    protected function getBuilderParameters()
    {
        $data = parent::getBuilderParameters();
        $data['dom'] = '<"datatable-header"lf><"datatable-scroll"t><"datatable-footer"ip>';
        $data['autoWidth'] = false;
        return $data;
    }

    public function forType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function forVendor($vendorId)
    {
        $this->vendor_id = $vendorId;
        return $this;
    }
}
