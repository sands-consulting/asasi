<?php

namespace App\DataTables;

use App\Vendor;

class VendorsDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function($vendor) {
                return view('admin.vendors._index_actions', compact('vendor'));
            })
            ->editColumn('name', function($vendor) {
                return link_to_route('admin.vendors.show', $vendor->name, $vendor->id);
            })
            ->editColumn('status', function($vendor) {
                return view('admin.vendors._index_status', compact('vendor'));
            })
            ->make(true);
    }

    public function query()
    {
        $query = Vendor::whereNotNull('name');

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
                'name'  => 'status',
                'title' => trans('vendors.attributes.status'),
            ]
        ];
    }

    protected function filename()
    {
        return 'vendors_dt_' . time();
    }
}
