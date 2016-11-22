<?php

namespace App\DataTables;

use App\Notice;
use App\Submission;
use App\EvaluationRequirement;

class EvaluatorSummaryDataTable extends DataTable
{
    public function ajax()
    {
        $dt = $this->datatables
            ->eloquent($this->query())
            ->editColumn('user_name', function($evaluator) {
                return link_to_route('admin.users.show', $evaluator->user_name, $evaluator->user_id);
            });

        $dt->editColumn('evaluation_score', function($evaluator) {
            return $evaluator->evaluation_score;
        });

        $dt->editColumn('evaluation_average', function($evaluator) {
            return $evaluator->evaluation_average . ' %';
        });

        $dt->editColumn('action', function($evaluator) {
            return view('admin.notices._evaluator_summary_actions', compact('evaluator'));
        });

        return $dt->make(true);
    }

    public function query()
    {
        $total_score = EvaluationRequirement::where('notice_id', $this->notice->id)
            ->where('evaluation_type_id', $this->type->id)
            ->sum('full_score');

        $query = Submission::query()
            ->select([
                'users.id as user_id',
                'users.name as user_name',
                'evaluation_types.name as evaluator_type',
                'submission_evaluator.evaluator_id as evaluator_id',
                'submissions.id as submission_id',
                'submissions.notice_id as notice_id',
                \DB::raw("SUM(evaluation_scores.score) as evaluation_score"),
                \DB::raw(
                    "FORMAT(SUM(evaluation_scores.score) / " . $total_score . " * 100, 2) as evaluation_average"
                ),
            ])
            ->leftJoin('submission_evaluator', 'submission_evaluator.submission_id', '=', 'submissions.id')
            ->leftJoin('notice_evaluator', 'notice_evaluator.id', '=', 'submission_evaluator.evaluator_id')
            ->leftJoin('users', 'users.id', '=', 'notice_evaluator.user_id')
            ->leftJoin('evaluation_types', 'evaluation_types.id', '=', 'notice_evaluator.type_id')
            ->leftJoin('evaluation_scores', function ($join) {
                $join->on('evaluation_scores.user_id', '=', 'users.id');
                $join->on('evaluation_scores.submission_id', '=', 'submissions.id');
            })
            ->where('submissions.id', $this->submission->id)
            ->where('submissions.notice_id', $this->notice->id)
            ->where('notice_evaluator.type_id', $this->type->id)
            ->groupBy(['users.name']);

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
            ->addAction(['width' => '10%'])
            ->parameters($this->getBuilderParameters());
    }

    protected function getColumns()
    {
        $columns[] = [
            'data' => 'user_name',
            'name' => 'user_name',
            'title' => trans('users.attributes.name'),
            'width' => '30%'
        ];

        $columns[] = [
            'data' => 'evaluator_type',
            'name' => 'evaluator_type',
            'title' => trans('evaluation-requirements.attributes.type_id'),
            'width' => '20%'
        ];

        $columns[] = [
            'data' => 'evaluation_score',
            'name' => 'evaluation_score',
            'title' => trans('evaluation-scores.attributes.score'),
            'width' => '10%',
            'class' => 'text-right' 
        ];

        $columns[] = [
            'data' => 'evaluation_average',
            'name' => 'evaluation_average',
            'title' => trans('evaluation-scores.attributes.score_average'),
            'width' => '15%',
            'class' => 'text-right' 
        ];

        return $columns;
    }

    protected function filename()
    {
        return 'notices_dt_' . time();
    }

    protected function getBuilderParameters()
    {
        $data = parent::getBuilderParameters();
        $data['dom'] = '<"datatable-header"l><"datatable-scroll"t><"datatable-footer"ip>';
        $data['autoWidth'] = false;
        return $data;
    }

    public function forNotice($notice)
    {
        $this->notice = $notice;

        return $this;
    }

    public function forType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function forSubmission($submission)
    {
        $this->submission = $submission;

        return $this;
    }
}
