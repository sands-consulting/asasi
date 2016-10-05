<?php

namespace App\DataTables;

use App\Subscription;

class SubscriptionsDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function($subscription) {
                return view('admin.subscriptions._index_actions', compact('subscription'));
            })
            ->editColumn('vendor_name', function($subscription) {
                return link_to_route('admin.subscriptions.show', $subscription->vendor_name, $subscription->id);
            })
            ->editColumn('package_name', function($subscription) {
                return view('admin.subscriptions._index_package', compact('subscription'));
            })
            ->editColumn('status', function($subscription) {
                return view('admin.subscriptions._index_status', compact('subscription'));
            })
            ->make(true);
    }

    public function query()
    {
        $query = Subscription::leftJoin('vendors', 'vendors.id', '=', 'subscriptions.vendor_id')
            ->leftJoin('packages', 'packages.id', '=', 'subscriptions.package_id')
            ->select(
                'subscriptions.id',
                'vendors.name as vendor_name', 
                'packages.name as package_name',
                'packages.label_color',
                'subscriptions.started_at',
                'subscriptions.expired_at',
                'subscriptions.status'
            );

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
                'data' => 'vendor_name',
                'name' => 'vendor_name',
                'title' => trans('vendors.attributes.name')
            ],
            [
                'data' => 'package_name',
                'name' => 'package_name',
                'title' => trans('packages.attributes.name')
            ],
            [
                'data' => 'started_at',
                'name' => 'started_at',
                'title' => trans('subscriptions.attributes.started_at')
            ],
            [
                'data' => 'expired_at',
                'name' => 'expired_at',
                'title' => trans('subscriptions.attributes.expired_at')
            ],
            [
                'data' => 'status',
                'name' => 'subscriptions.status',
                'title' => trans('subscriptions.attributes.status')
            ],
        ];
    }

    protected function filename()
    {
        return 'subscriptions_dt_' . time();
    }

    protected function getBuilderParameters()
    {
        $data = parent::getBuilderParameters();
        $data['dom'] = '<"datatable-header"l><"datatable-scroll"t><"datatable-footer"ip>';
        return $data;
    }
}
