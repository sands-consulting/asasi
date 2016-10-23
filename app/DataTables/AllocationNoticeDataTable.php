<?php

namespace App\DataTables;

use App\Notice;

class AllocationNoticeDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('name', function($notice) {
                return link_to_route('admin.notices.show', $notice->name, $notice->id);
            })
            ->editColumn('status', function($notice) {
                return view('admin.notices._index_status', compact('notice'));
            })
            ->make(true);
    }

    public function query()
    {
        $query = Notice::whereNotNull('name');

        switch ($this->datatables->request->input('filter', null)) {
            case 'allocated':
                $query->whereHas('allocations', function($subquery) {
                    $subquery->where('allocations.id', $this->id);
                })->where('notices.status', '!=', 'awarded');

                break;
            case 'usage':
                $query->whereHas('allocations', function($subquery) {
                    $subquery->where('allocations.id', $this->id);
                })->where('notices.status', 'awarded');
                break;
            default:
                $query->whereHas('allocations', function($subquery) {
                    $subquery->where('allocations.id', $this->id);
                });
                break;
        }

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
                'title' => trans('notices.attributes.name'),
                'width' => '40%'
            ],
            [
                'data' => 'number',
                'name' => 'number',
                'title' => trans('notices.attributes.number'),
                'width' => '15%'
            ],
            [
                'data' => 'published_at',
                'name' => 'published_at',
                'title' => trans('notices.attributes.published_at'),
                'width' => '15%'
            ],
            [
                'data' => 'status',
                'name' => 'status',
                'title' => trans('notices.attributes.status'),
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
        $data['dom'] = '<"datatable-header"l><"datatable-scroll"t><"datatable-footer"ip>';
        $data['autoWidth'] = false;
        return $data;
    }

    public function forId($id)
    {
        $this->id = $id;
        return $this;
    }
}
