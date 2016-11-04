<?php

namespace App\DataTables;

use App\Evaluations;
use App\NoticeEvaluator;
use Auth;

class EvaluationDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function($evaluator) {
                return view('admin.evaluations._index_actions', compact('evaluator'));
            })
            ->editColumn('type', function($evaluator) {
                return str_titleize($evaluator->type);
            })
            ->make(true);
    }

    public function query()
    {
        $evaluatorId = Auth::user()->id;
        $query = NoticeEvaluator::leftJoin('notices', 'notices.id', '=', 'notice_evaluator.notice_id')
            ->leftJoin('organizations', 'organizations.id', '=', 'notices.organization_id')
            ->leftJoin('evaluation_types', 'evaluation_types.id', '=', 'notice_evaluator.type_id')
            ->select([
                'notices.id as notice_id',
                'organizations.name as organization_name',
                'notices.name as notice_name',
                'notices.number as notice_number',
                'evaluation_types.name as evaluation_type'
            ])
            ->where('notice_evaluator.user_id', $evaluatorId)
            ->where('notice_evaluator.status', 'active');

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
                'data'  => 'notice_number',
                'name'  => 'notice_number',
                'title' => trans('notices.attributes.number'),
                'sWidth' => '20%',
            ],
            [
                'data'  => 'notice_name',
                'name'  => 'notice_name',
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
