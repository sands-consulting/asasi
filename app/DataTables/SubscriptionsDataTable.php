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
                return view('subscriptions._index_actions', compact('subscription'));
            })
            ->editColumn('name', function($subscription) {
                return link_to_route('subscriptions.show', $subscription->name, $subscription->id);
            })
            ->editColumn('status', function($subscription) {
                return view('subscriptions._index_status', compact('subscription'));
            })
            ->make(true);
    }

    public function query()
    {
        $query = Subscription::with('package');

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
                'data'  => 'package.name',
                'name'  => 'package.name',
                'title' => trans('subscriptions.attributes.name'),
            ],
            [
                'data'  => 'subscription.started_at',
                'name'  => 'subscription.started_at',
                'title' => trans('subscriptions.attributes.started_at'),
            ],
            [
                'data'  => 'subscription.expired_at',
                'name'  => 'subscription.expired_at',
                'title' => trans('subscriptions.attributes.expired_at'),
            ]
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
