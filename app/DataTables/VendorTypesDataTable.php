<?php

namespace App\DataTables;

use App\VendorType;

class VendorTypesDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function ($type) {
                return view('admin.vendor-types._index_actions', compact('type'));
            })
            ->editColumn('status', function ($type) {
                return trans('statuses.' . $type->status);
            })
            ->make(true);
    }

    public function query()
    {
        return $this->applyScopes(VendorType::query());
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
                'data'  => 'incorporation_authority',
                'name'  => 'vendor_types.incorporation_authority',
                'title' => trans('vendor-types.attributes.incorporation_authority'),
            ],
            [
                'data'  => 'incorporation_type',
                'name'  => 'vendor_types.incorporation_type',
                'title' => trans('vendor-types.attributes.incorporation_type'),
            ],
            [
                'data'  => 'status',
                'name'  => 'vendor_types.status',
                'title' => trans('news.attributes.status'),
            ],
        ];
    }

    protected function filename()
    {
        return 'news_categories_dt_' . time();
    }
}
