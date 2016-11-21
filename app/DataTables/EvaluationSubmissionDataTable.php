<?php

namespace App\DataTables;

use App\Submission;
use App\NoticeEvaluator;
use Auth;

class EvaluationSubmissionDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function($submission) {
                return view('admin.evaluations._submission_actions', compact('submission'));
            })
            ->editColumn('type_name', function($submission) {
                return ucwords($submission->type_name);
            })
            ->make(true);
    }

    public function query()
    {
        $query = Submission::query()
            ->select([
                'submissions.id as submission_id',
                'submissions.notice_id as notice_id',
                'notice_evaluator.id as evaluator_id',
                'evaluation_types.name as type_name',
                'submission_evaluator.status as evaluation_status'
            ])
            ->whereHas('evaluators', function($query) {
                $query->where('user_id', $this->user_id)
                    ->where('notice_id', $this->notice_id);
            })
            ->leftJoin('notice_evaluator', function($join) {
                $join->on('notice_evaluator.notice_id', '=', 'submissions.notice_id');
            })
            ->leftJoin('submission_evaluator', function($join) {
                $join->on('submission_evaluator.submission_id', '=', 'submissions.id');
                $join->on('submission_evaluator.evaluator_id', '=', 'notice_evaluator.id');
            })
            ->leftJoin('evaluation_types', 'evaluation_types.id', '=', 'notice_evaluator.type_id')
            ->where('submissions.notice_id', $this->notice_id)
            ->where('notice_evaluator.user_id', $this->user_id);
            

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
                'data'  => 'submission_id',
                'name'  => 'submissions.id',
                'title' => trans('submissions.attributes.id'),
                'sWidth' => '200px',
            ],
            [
                'data'  => 'type_name',
                'name'  => 'evaluation_types.name',
                'title' => trans('evaluation-requirements.attributes.type_id'),
            ],
            [
                'data'  => 'evaluation_status',
                'name'  => 'submission_evaluator.status',
                'title' => trans('submissions.attributes.status'),
                'searchable' => false,
            ]
        ];

        return $columns;
    }

    protected function filename()
    {
        return 'evaluations_dt_' . time();
    }

    public function byUserId($userId)
    {
        $this->user_id = $userId;
        return $this;
    }

    public function byNoticeId($noticeId)
    {
        $this->notice_id = $noticeId;
        return $this;
    }

    protected function getBuilderParameters()
    {
        $data = parent::getBuilderParameters();
        $data['dom'] = '<"datatable-header"lf><"datatable-scroll"t><"datatable-footer"ip>';
        return $data;
    }
}
