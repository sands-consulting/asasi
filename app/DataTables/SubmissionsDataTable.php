<?php

namespace App\DataTables;

use App\Submission;

class SubmissionsDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function($submission) {
                return view('admin.submissions._index_actions', compact('submission'));
            })
            ->editColumn('notice_id', function($submission) {
                // return link_to_route('admin.submissions.show', $submission->notice->name, $submission->id);
                return $submission->notice->name;
            })
            ->editColumn('vendor_id', function($submission) {
                return link_to_route('admin.submissions.show', $submission->vendor->name, $submission->id);
            })
            ->editColumn('status', function($submission) {
                return view('admin.submissions._index_status', compact('submission'));
            })
            ->make(true);
    }

    public function query()
    {
        $query = Submission::whereNotNull('vendor_id');

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
        return [
            [
                'data' => 'vendor_id',
                'name' => 'vendor_id',
                'title' => trans('submissions.attributes.vendor_id')
            ],
            [
                'data' => 'notice_id',
                'name' => 'notice_id',
                'title' => trans('submissions.attributes.notice_id')
            ],
            [
                'data' => 'created_at',
                'name' => 'created_at',
                'title' => trans('submissions.attributes.created_at')
            ],
        ];
    }

    protected function filename()
    {
        return 'submission_dt_' . time();
    }

    protected function getBuilderParameters()
    {
        $data = parent::getBuilderParameters();
        $data['dom'] = '<"datatable-header"l><"datatable-scroll"t><"datatable-footer"ip>';
        return $data;
    }
}
