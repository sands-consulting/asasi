<?php

namespace App\DataTables;

use App\PaymentGateway;

class PaymentGatewaysDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function($gateway) {
                return view('admin.payment-gateways.index.actions', compact('gateway'));
            })
            ->editColumn('status', function($gateway) {
                return view('admin.payment-gateways.index.status', compact('gateway'));
            })
            ->editColumn('default', function($gateway) {
                return boolean_icon($gateway->default);
            })
            ->make(true);
    }

    public function query()
    {
        $query = PaymentGateway::query();

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
                'title' => trans('payment-gateways.attributes.name')
            ],
            [
                'data' => 'type',
                'name' => 'type',
                'title' => trans('payment-gateways.attributes.fee')
            ],
            [
                'data' => 'prefix',
                'name' => 'prefix',
                'title' => trans('payment-gateways.attributes.status')
            ],
            [
                'data' => 'default',
                'name' => 'default',
                'title' => trans('payment-gateways.attributes.default')
            ],
            [
                'data' => 'status',
                'name' => 'status',
                'title' => trans('payment-gateways.attributes.status')
            ],
        ];
    }

    protected function filename()
    {
        return 'gateways_dt_' . time();
    }

    protected function getBuilderParameters()
    {
        $data = parent::getBuilderParameters();
        $data['dom'] = '<"datatable-header"l><"datatable-scroll"t><"datatable-footer"ip>';
        return $data;
    }
}
