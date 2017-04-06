<?php

namespace App\DataTables;

use App\TaxCode;

class TaxCodesDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function ($taxCode) {
                return view('admin.tax-codes._index_actions', compact('taxCode'));
            })
            ->editColumn('status', function ($taxCode) {
                return view('admin.tax-codes._index_status', compact('taxCode'));
            })
            ->make(true);
    }

    public function query()
    {
        $query = TaxCode::whereNotNull('name');

        if ($this->datatables->request->input('q', null)) {
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
                'name'  => 'name',
                'title' => trans('tax-codes.attributes.name'),
            ],
            [
                'data'  => 'code',
                'name'  => 'code',
                'title' => trans('tax-codes.attributes.code'),
            ],
            [
                'data'  => 'rate',
                'name'  => 'rate',
                'title' => trans('tax-codes.attributes.rate'),
            ],
            [
                'data'  => 'status',
                'name'  => 'status',
                'title' => trans('tax-codes.attributes.status'),
            ],
        ];
    }

    protected function filename()
    {
        return 'tax_codes_dt_' . time();
    }

    protected function getBuilderParameters()
    {
        $data = parent::getBuilderParameters();
        $data['dom'] = '<"datatable-header"l><"datatable-scroll"t><"datatable-footer"ip>';
        return $data;
    }
}
