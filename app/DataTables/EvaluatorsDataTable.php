<?php

namespace App\DataTables;

use App\NoticeEvaluator;
use Auth;

class EvaluatorsDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function($evaluator) {
                return view('admin.evaluators._index_actions', compact('evaluator'));
            })
            ->editColumn('evaluator_status', function($evaluator) {
                return view('admin.evaluators._index_status', compact('evaluator'));
            })
            ->make(true);
    }

    public function query()
    {
        $query = NoticeEvaluator::with(['user', 'notice', 'type'])
            ->leftJoin('users', 'users.id', '=','notice_evaluator.user_id')
            ->leftJoin('evaluation_types', 'evaluation_types.id', '=','notice_evaluator.type_id')
            ->where('notice_evaluator.notice_id', $this->notice->id)
            ->select([
                'notice_evaluator.id as evaluator_id',
                'notice_evaluator.notice_id as notice_id',
                'notice_evaluator.user_id as user_id',
                'notice_evaluator.status as evaluator_status',
                'users.name as evaluator_name',
                'evaluation_types.name as type_name',
            ]);

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
                'data'  => 'evaluator_name',
                'name'  => 'evaluator_name',
                'title' => trans('users.attributes.name'),
                'sWidth' => '30%',
            ],
            [
                'data'  => 'type_name',
                'name'  => 'type_name',
                'title' => trans('notice-evaluators.attributes.type'),
                'sWidth' => '25%',
            ],
            [
                'data'  => 'evaluator_status',
                'name'  => 'evaluator_status',
                'title' => trans('notice-evaluators.attributes.status'),
                'sWidth' => '25%',
            ],
        ];

        return $columns;
    }

    public function with($name, $data)
    {
        $this->$name = $data;
        return $this;
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
