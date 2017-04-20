<?php

namespace App\DataTables;

use App\Evaluation;

class EvaluationsDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('status', function($evaluation) {
                return view('admin.evaluations.index.status', compact('evaluation'));
            })
            ->editColumn('action', function ($evaluation) {
                return view('admin.evaluations.index.actions', compact('evaluation'));
            })
            ->make(true);
    }

    public function query()
    {
        $query = Evaluation::whereUserId($this->userId)
            ->where('evaluations.status', '!=', 'rejected')
            ->leftJoin('notices', 'notices.id', '=', 'evaluations.notice_id')
            ->leftJoin('submissions', 'submissions.id', '=', 'evaluations.submission_id')
            ->leftJoin('evaluation_types', 'evaluation_types.id', '=', 'evaluations.type_id')
            ->select('notices.name as notice', 'evaluation_types.name as type', 'submissions.number as submission_number', 'evaluations.*');

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
                'data'  => 'notice',
                'name'  => 'notices.name',
                'title' => trans('evaluations.attributes.notice'),
            ],
            [
                'data'  => 'type',
                'name'  => 'evaluation_types.name',
                'title' => trans('evaluations.attributes.type'),
            ],
            [
                'data'  => 'submission_number',
                'name'  => 'submissions.number',
                'title' => trans('evaluations.attributes.submission'),
            ],
            [
                'data'  => 'status',
                'name'  => 'evaluations.status',
                'title' => trans('evaluations.attributes.status'),
            ],
        ];

        return $columns;
    }

    protected function filename()
    {
        return 'evaluations_dt_' . time();
    }

    protected function getBuilderParameters()
    {
        $data = parent::getBuilderParameters();
        $data['dom'] = '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>';
        return $data;
    }
}
