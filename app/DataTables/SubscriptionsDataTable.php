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
                return view('admin.subscriptions.index.actions', compact('subscription'));
            })
            ->editColumn('package_name', function($subscription) {
                return view('admin.subscriptions.index.package', compact('subscription'));
            })
            ->editColumn('status', function($subscription) {
                return view('admin.subscriptions.index.status', compact('subscription'));
            })
            ->make(true);
    }

    public function query()
    {
        $query = Subscription::leftJoin('packages', 'packages.id', '=', 'subscriptions.package_id')
            ->select(
                'subscriptions.id',
                'subscriptions.number',
                'packages.name as package_name',
                'subscriptions.start_at',
                'subscriptions.end_at',
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
                'data' => 'number',
                'name' => 'number',
                'title' => trans('subscriptions.attributes.number')
            ],
            [
                'data' => 'package_name',
                'name' => 'package.name',
                'title' => trans('subscriptions.views.admin.index.package')
            ],
            [
                'data' => 'start_at',
                'name' => 'start_at',
                'title' => trans('subscriptions.attributes.start_at')
            ],
            [
                'data' => 'end_at',
                'name' => 'end_at',
                'title' => trans('subscriptions.attributes.end_at')
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
