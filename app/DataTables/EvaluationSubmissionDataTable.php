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
            ->editColumn('name', function($submission) {
                return link_to_route('admin.evaluations.create', $submission->name, [$submission->notice_id, $submission->id]);
            })
            ->editColumn('avg_score', function($submission) {
                return $submission->score_avg;
            })
            ->editColumn('evaluation_status', function($submission) {
                return $submission->evaluators()->first()->pivot->status;
            })
            ->make(true);
    }

    public function query()
    {
        $types = NoticeEvaluator::where('user_id', $this->user_id)
            ->where('notice_id', $this->notice_id)
            ->lists('type');

        $query = Submission::with(['evaluators' => function ($subquery) {
                $subquery->wherePivot('user_id', $this->user_id);
            }])
            ->where('notice_id', $this->notice_id)
            ->whereIn('type', $types);


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
                'data'  => 'id',
                'name'  => 'id',
                'title' => trans('submissions.attributes.id'),
                'sWidth' => '200px',
            ],
            [
                'data'  => 'type',
                'name'  => 'submission.type',
                'title' => trans('submissions.attributes.type'),
            ],
            [
                'data'  => 'evaluation_status',
                'name'  => 'evaluation_status',
                'title' => trans('submissions.attributes.status'),
            ],
            [
                'data'  => 'avg_score',
                'name'  => 'avg_score',
                'title' => trans('submissions.attributes.avg_score'),
            ],
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

    public function forType($type)
    {
        $this->type = $type;
        return $this;
    }

    protected function getBuilderParameters()
    {
        $data = parent::getBuilderParameters();
        $data['dom'] = '<"datatable-header"l><"datatable-scroll"t><"datatable-footer"ip>';
        return $data;
    }
}
