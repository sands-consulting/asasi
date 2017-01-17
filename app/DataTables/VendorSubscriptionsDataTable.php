<?php

namespace App\DataTables;

class VendorSubscriptionsDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('started_at', function($subscription) {
                return $subscription->started_at->toDateString();
            })
            ->editColumn('expired_at', function($subscription) {
                return $subscription->expired_at->toDateString();
            })
            ->editColumn('status', function($subscription) {
                return view('subscriptions._index_status', compact('subscription'));
            })
            ->make(true);
    }

    public function query()
    {
        $query = $this->vendor->subscriptions()
            ->select(
                'packages.name',
                'subscriptions.started_at',
                'subscriptions.expired_at',
                'subscriptions.status'
            )
            ->leftJoin('packages', 'packages.id', '=', 'subscriptions.package_id');

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
                'data'  => 'name',
                'name'  => 'packages.name',
                'title' => trans('subscriptions.attributes.name'),
            ],
            [
                'data'  => 'started_at',
                'name'  => 'subscriptions.started_at',
                'title' => trans('subscriptions.attributes.started_at'),
            ],
            [
                'data'  => 'expired_at',
                'name'  => 'subscriptions.expired_at',
                'title' => trans('subscriptions.attributes.expired_at'),
            ],
            [
                'data'  => 'status',
                'name'  => 'subscriptions.status',
                'title' => trans('subscriptions.attributes.status'),
            ]
        ];
    }

    protected function filename()
    {
        return 'vendor_subscriptions_dt_' . time();
    }

    protected function getBuilderParameters()
    {
        $data = parent::getBuilderParameters();
        $data['dom'] = '<"datatable-header"lf><"datatable-scroll"t><"datatable-footer"ip>';
        return $data;
    }
}
