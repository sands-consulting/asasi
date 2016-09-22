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
            ->addColumn('action', function($notice) {
                return view('admin.evaluations._index_actions', compact('notice'));
            })
            ->editColumn('name', function($notice) {
                return link_to_route('admin.evaluations.vendors', $notice->name, [$notice->type]);
            })
            ->make(true);
    }

    public function query()
    {
        $evaluatorId = Auth::user()->id;
        $query = NoticeEvaluator::leftJoin('notices', 'notices.id', '=', 'notice_evaluators.notice_id')->where('user_id', $evaluatorId);


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
                'title' => trans('notices.attributes.name'),
            ]
        ];

        return $columns;
    }

    protected function filename()
    {
        return 'evaluations_dt_' . time();
    }
}
