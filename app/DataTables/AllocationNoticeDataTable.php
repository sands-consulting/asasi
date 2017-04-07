<?php

namespace App\DataTables;

use App\Notice;
use App\Project;

class AllocationNoticeDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('name', function($notice) {
                return link_to_route('admin.allocations.show', $notice->name, $notice->id);
            })
            ->editColumn('status', function($notice) {
                return view('admin.allocations._show_status', compact('notice'));
            })
            ->make(true);
    }

    public function query()
    {
        switch ($this->datatables->request->input('filter', null)) {
            case 'allocated':
                $query = Project::query();

                break;
            case 'reserved':
                $query = Notice::query();

                break;
            default:
                $first = Notice::select('name', 'number', 'status')->getQuery();
                $query = Project::select('name', 'number', 'status')->union($first);
                break;
        }

        $query->whereHas('allocations', function($subquery) {
            $subquery->where('allocations.id', $this->id);
        });

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

        $columns = [
            [
                'data' => 'name',
                'name' => 'name',
                'title' => trans('notices.attributes.name')
            ],
            [
                'data'    => 'number',
                'name'    => 'number',
                'title'   => trans('notices.attributes.number'),
                'visible' => false,
            ],
            [
                'data' => 'status',
                'name' => 'status',
                'title' => trans('notices.attributes.status')
            ],
        ];
                
        return $columns;
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

    public function forId($id)
    {
        $this->id = $id;
        return $this;
    }
}
