<?php

namespace App\DataTables;

use App\Evaluation;
use Auth;

class EvaluationDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function ($evaluation) {
                return view('admin.evaluations._index_actions', compact('evaluation'));
            })
            ->editColumn('evaluation_id', function ($evaluation) {
                return $evaluation->id;
            })
            ->editColumn('submission_number', function ($evaluation) {
                return $evaluation->submission->number;
            })
            ->editColumn('evaluation_type', function ($evaluation) {
                return $evaluation->type->name;
            })
            ->editColumn('notice_number', function ($evaluation) {
                return $evaluation->notice->number;
            })
            ->editColumn('evaluation_status', function ($evaluation) {
                return $evaluation->status;
            })
            ->make(true);
    }

    public function query()
    {
        $evaluatorId = Auth::user()->id;
        // $query = NoticeEvaluator::leftJoin('notices', 'notices.id', '=', 'notice_evaluator.notice_id')
        //     ->leftJoin('organizations', 'organizations.id', '=', 'notices.organization_id')
        //     ->leftJoin('evaluation_types', 'evaluation_types.id', '=', 'notice_evaluator.type_id')
        //     ->select([
        //         'notices.id as notice_id',
        //         'organizations.name as organization_name',
        //         'notices.name as notice_name',
        //         'notices.number as notice_number',
        //         'evaluation_types.name as evaluation_type'
        //     ])
        //     ->where('notice_evaluator.user_id', $evaluatorId)
        //     ->where('notice_evaluator.status', 'active');
        $query = Evaluation::query()
            ->with('notice', 'submission', 'type')
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
                'data'  => 'evaluation_id',
                'name'  => 'id',
                'title' => trans('evaluations.attributes.id'),
            ],
            [
                'data'   => 'submission_number',
                'name'   => 'submission.number',
                'title'  => trans('evaluations.attributes.submission'),
                'sWidth' => '20%',
            ],
            [
                'data'  => 'evaluation_type',
                'name'  => 'type.name',
                'title' => trans('evaluations.attributes.type'),
            ],
            [
                'data'  => 'notice_number',
                'name'  => 'notice.number',
                'title' => trans('evaluations.attributes.notice'),
            ],
            [
                'data'  => 'evaluation_status',
                'name'  => 'status',
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
