<?php

namespace App\DataTables;

use App\Submission;
use App\Notice;

class SubmissionNoticesDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function($notice) {
                return view('admin.submissions._notices_index_actions', compact('notice'));
            })
            ->editColumn('organization_id', function($notice) {
                // return link_to_route('admin.organizations.show', $notice->organization->short_name, $notice->organization_id);
                return $notice->organization->short_name;
            })
            // ->editColumn('name', function($notice) {
                // return link_to_route('admin.submissions.show', $notice->name, $notice->id);
                // return link_to_route('admin.submissions.show', $notice->name, $notice->id);
            // })
            ->editColumn('status', function($notice) {
                return view('admin.submissions._notices_index_status', compact('notice'));
            })
            ->make(true);
    }

    public function query()
    {
        $query = Notice::whereNotNull('name');

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
                'data' => 'number',
                'name' => 'number',
                'title' => trans('notices.attributes.number')
            ],
            [
                'data' => 'organization_id',
                'name' => 'organization_id',
                'title' => trans('notices.attributes.organization_id')
            ],
            [
                'data' => 'name',
                'name' => 'name',
                'title' => trans('notices.attributes.name')
            ],
        ];
    }

    protected function filename()
    {
        return 'submission_notices_dt_' . time();
    }

    protected function getBuilderParameters()
    {
        $data = parent::getBuilderParameters();
        $data['dom'] = '<"datatable-header"l><"datatable-scroll"t><"datatable-footer"ip>';
        return $data;
    }
}
