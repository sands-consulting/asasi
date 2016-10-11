<?php

namespace App\DataTables;

use App\Notice;
use App\NoticeEvaluator;
use Auth;

class EvaluationNoticesDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function($notice) {
                return view('admin.evaluation-requirements._index_actions', compact('notice'));
            })
            ->make(true);
    }

    public function query()
    {
        $query = Notice::whereNotNull('name');

        if($this->datatables->request->input('q', null)) {
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
        $columns = [
            [
                'data'  => 'number',
                'name'  => 'number',
                'title' => trans('notices.attributes.number'),
            ],
            [
                'data'  => 'name',
                'name'  => 'name',
                'title' => trans('notices.attributes.name'),
            ],
            [
                'data'  => 'notice_type_id',
                'name'  => 'notice_type_id',
                'title' => trans('notice-evaluators.attributes.type'),
            ]
        ];

        return $columns;
    }

    protected function filename()
    {
        return 'evaluations_dt_' . time();
    }
}
