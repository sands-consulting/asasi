<?php

namespace App\DataTables;

use App\Evaluations;
use App\NoticeEvaluator;
use Auth;

class EvaluationsDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function($noticeEvaluator) {
                return view('admin.evaluations._index_actions', compact('noticeEvaluator'));
            })
            ->editColumn('type', function($noticeEvaluator) {
                return ucfirst(strtolower($noticeEvaluator->type));
            })
            ->make(true);
    }

    public function query()
    {
        $evaluatorId = Auth::user()->id;
        $query = NoticeEvaluator::leftJoin('notices', 'notices.id', '=', 'notice_evaluators.notice_id')
            ->leftJoin('organizations', 'organizations.id', '=', 'notices.organization_id')
            ->select('notices.id', 'organizations.name as organization_name', 'notices.name', 'notices.number')
            ->where('user_id', $evaluatorId);

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
        $columns = [
            [
                'data'  => 'organization_name',
                'name'  => 'organizations.name',
                'title' => trans('notices.attributes.organization_id'),
                'sWidth' => '25%',
            ],
            [
                'data'  => 'number',
                'name'  => 'number',
                'title' => trans('notices.attributes.number'),
                'sWidth' => '20%',
            ],
            [
                'data'  => 'name',
                'name'  => 'notices.name',
                'title' => trans('notices.attributes.name'),
            ]
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
