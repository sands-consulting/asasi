<?php

namespace App\DataTables;

use App\AllocationType;

class AllocationTypesDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function($type) {
                return view('admin.allocation-types._index_actions', compact('type'));
            })
            ->editColumn('name', function($type) {
                return link_to_route('admin.allocation-types.edit', $type->name, $type->id);
            })
            ->editColumn('status', function($type) {
                return trans('statuses.' . $type->status);
            })
            ->editColumn('created_at', function($type) {
                return $type->created_at->format('d/m/Y H:i:s');
            })
            ->make(true);
    }

    public function query()
    {
        $query = AllocationType::query();

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
                'name'  => 'allocation_types.name',
                'title' => trans('allocation-types.attributes.name'),
            ],
            [
                'data'  => 'status',
                'name'  => 'allocation_types.status',
                'title' => trans('allocation-types.attributes.status'),
            ],
            [
                'data'  => 'created_at',
                'name'  => 'allocation_types.status',
                'title' => trans('allocation-types.attributes.created_at'),
            ]
        ];
    }

    protected function filename()
    {
        return 'allocation_types_dt_' . time();
    }
}
