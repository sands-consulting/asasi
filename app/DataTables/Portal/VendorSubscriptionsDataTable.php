<?php

namespace App\DataTables\Portal;

use App\Subscription;

class VendorSubscriptionsDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('start_at', function ($subscription) {
                return $subscription->start_at->format('d/m/Y');
            })
            ->editColumn('end_at', function ($subscription) {
                return $subscription->end_at->format('d/m/Y');
            })
            ->editColumn('status', function ($subscription) {
                return view('admin.subscriptions.index.status', compact('subscription'));
            })
            ->addColumn('action', function ($subscription) {
                return view('subscriptions.index.actions', compact('subscription'));
            })
            ->make(true);
    }

    public function query()
    {
        $query = Subscription::orderBy('subscriptions.created_at', 'asc')
            ->leftJoin('packages', 'packages.id', '=', 'subscriptions.package_id')
            ->select([
                'subscriptions.id',
                'subscriptions.number',
                'packages.name as package_name',
                'subscriptions.start_at',
                'subscriptions.end_at',
                'subscriptions.status'
            ]);

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
                'data'  => 'number',
                'name'  => 'subscriptions.number',
                'title' => trans('subscriptions.attributes.number'),
            ],
            [
                'data'  => 'package_name',
                'name'  => 'packages.name',
                'title' => trans('subscriptions.attributes.package'),
            ],
            [
                'data'  => 'start_at',
                'name'  => 'subscriptions.start_at',
                'title' => trans('subscriptions.attributes.start_at'),
            ],
            [
                'data'  => 'end_at',
                'name'  => 'subscriptions.end_at',
                'title' => trans('subscriptions.attributes.end_at'),
            ],
            [
                'data'  => 'status',
                'name'  => 'subscriptions.status',
                'title' => trans('subscriptions.attributes.status')
            ]
        ];
    }

    protected function getBuilderParameters()
    {
        $data = parent::getBuilderParameters();
        $data['dom'] = '<"datatable-header"lf><"datatable-scroll"t><"datatable-footer"ip>';
        return $data;
    }

    protected function filename()
    {
        return 'subscriptions_' . time();
    }
}
