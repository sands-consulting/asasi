<?php

namespace App\DataTables;

class UserLogsDataTable extends DataTable
{
    protected $logable;

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
        $query = $this->actionable->logs()->with('user');
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
                'data'  => 'action',
                'title' => trans('user-logs.attributes.action'),
            ],
            [
                'data'  => 'ip_address',
                'title' => trans('user-logs.attributes.ip_address'),
            ],
            [
                'data'          => 'user',
                'title'         => trans('user-logs.attributes.user'),
                'searchable'    => false,
                'orderable'     => false
            ],
            [
                'data'  => 'created_at',
                'title' => trans('user-logs.attributes.created_at'),
            ],
        ];
    }

    protected function filename()
    {
        return 'user_logs_' . time();
    }
}
