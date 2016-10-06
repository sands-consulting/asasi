<?php

namespace App\DataTables;

use App\Allocation;

class AllocationDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function($allocation) {
                return view('admin.allocations._index_actions', compact('allocation'));
            })
            ->editColumn('name', function($allocation) {
                return link_to_route('admin.allocations.show', $allocation->name, $allocation->id);
            })
             ->editColumn('value', function($allocation) {
                return number_format($allocation->value, 2);
            })
            ->editColumn('status', function($allocation) {
                return trans('statuses.' . $allocation->status);
            })
            ->editColumn('created_at', function($allocation) {
                return $allocation->created_at->format('d/m/Y H:i:s');
            })
            ->editColumn('organization', function($allocation) {
                return $allocation->organization->name;
            })
            ->editColumn('type', function($allocation) {
                return $allocation->type->name;
            })
            ->make(true);
    }

    public function query()
    {
        $query = Allocation::with('organization', 'type');
        $query = $query->leftJoin('allocation_types', 'allocations.type_id', '=', 'allocation_types.id');
        $query = $query->leftJoin('organizations', 'allocations.organization_id', '=', 'organizations.id');
        $query = $query->select('allocations.*', 'allocation_types.name', 'organizations.name');

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
        $columns = [
            [
                'data'  => 'name',
                'name'  => 'allocations.name',
                'title' => trans('allocations.attributes.name'),
            ],
            [
                'data'  => 'value',
                'name'  => 'allocations.value',
                'title' => trans('allocations.attributes.value')
            ],
            [
                'data'  => 'type',
                'name'  => 'allocation_types.name',
                'title' => trans('allocations.attributes.type')
            ]
        ];

        if(!$this->user->hasPermission('allocation:organziation'))
        {
            $columns[] = [
                'data'  => 'organization',
                'name'  => 'organizations.name',
                'title' => trans('allocations.attributes.organization')
            ];
        }

        $columns[] = [
            'data'  => 'status',
            'name'  => 'allocations.status',
            'title' => trans('allocations.attributes.status'),
        ];
        $columns[] = [
            'data' => 'created_at',
            'name' => 'allocations.created_at',
            'title' => trans('allocations.attributes.created_at')
        ];

        return $columns;
    }

    protected function filename()
    {
        return 'allocations_dt_' . time();
    }
}
