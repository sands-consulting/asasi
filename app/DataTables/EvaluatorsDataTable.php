<?php

namespace App\DataTables;

use App\Evaluations;
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
            ->editColumn('type', function($evaluator) {
                return ucfirst(strtolower($evaluator->type));
            })
            ->editColumn('status', function($evaluator) {
                return view('admin.evaluators._index_status', compact('evaluator'));
            })
            ->make(true);
    }

    public function query()
    {
        $query = NoticeEvaluator::where('notice_id', $this->notice->id)
            ->leftJoin('users', 'users.id', '=', 'notice_evaluators.user_id')
            ->select([
                'users.name as name',
                'notice_evaluators.type as type',
                'notice_evaluators.status as status',
                'notice_evaluators.user_id as user_id',
                'notice_evaluators.notice_id as notice_id'
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
                'data'  => 'name',
                'name'  => 'name',
                'title' => trans('users.attributes.name'),
                'sWidth' => '30%',
            ],
            [
                'data'  => 'type',
                'name'  => 'type',
                'title' => trans('notice-evaluators.attributes.type'),
                'sWidth' => '25%',
            ],
            [
                'data'  => 'status',
                'name'  => 'status',
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
