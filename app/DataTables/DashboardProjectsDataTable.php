<?php

namespace App\DataTables;

use App\Project;

class DashboardProjectsDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('code', function() {
                return '-';
            })
            ->editColumn('name', function($notice) {
                $name  = "<span class='text-header'>$notice->number</span> <br />";
                $name .= link_to_route('notices.show', $notice->name, $notice->id);
                return $name;
            })
            ->editColumn('status', function($notice) {
                // return view('notices._index_status', compact('notice'));
            })
            ->removeColumn('number')
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
