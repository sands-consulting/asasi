<?php

namespace App\DataTables;

class UserHistoriesDataTable extends DataTable
{
    protected $actionable;

    public function setActionable($actionable)
    {
        $this->actionable = $actionable;
    }

    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('action', function($log) {
                return ucfirst($log->action);
            })
            ->editColumn('created_at', function($log) {
                return $log->created_at->format('d/m/Y H:i:s');
            })
            ->addColumn('user', function($log) {
                return $log->user->name;
            })
            ->make(true);
    }

    public function query()
    {
        $query = $this->actionable->histories()->with('user');
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
                'data'  => 'created_at',
                'title' => trans('user-histories.attributes.created_at'),
            ],
            [
                'data'          => 'user',
                'title'         => trans('user-histories.attributes.user'),
                'searchable'    => false,
                'orderable'     => false
            ],
            [
                'data'  => 'action',
                'title' => trans('user-histories.attributes.action'),
            ],
            [
                'data'  => 'ip_address',
                'title' => trans('user-histories.attributes.ip_address'),
            ],
        ];
    }

    protected function filename()
    {
        return 'user_histories_' . time();
    }
}
