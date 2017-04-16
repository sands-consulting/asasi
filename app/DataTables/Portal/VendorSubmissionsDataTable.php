<?php

namespace App\DataTables\Portal;

use App\Libraries\Carbon;
use App\NoticePurchase;

class VendorSubmissionsDataTable extends DataTable
{
    public $vendor;

    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('notice', function($submission) {
                $notice = $submission->notice;
                return view('notices.index.name', compact('notice'));
            })
            ->editColumn('submitted_at', function ($submission) {
                return ! is_null($submission->submitted_at)
                    ? Carbon::parse($submission->submitted_at)->formatDateTimeFromSetting()
                    : '<span class="icon-cross3"></span>';
            })
            ->addColumn('action', function ($submission) {
                return view('vendors.submissions.index.actions', compact('submission'));
            })
            ->make(true);
    }

    public function query()
    {
        $query = $this->vendor->submissions()->with('notice')->leftJoin('notices', 'notices.id', '=', 'submissions.notice_id')->select('submissions.*');

        if ($this->datatables->request->input('q', null)) {
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
                'data'  => 'notice',
                'name'  => 'notices.name',
                'title' => trans('notices.attributes.name'),
                'width' => '40%',
            ],
            [
                'data'  => 'submitted_at',
                'name'  => 'submissions.submitted_at',
                'title' => trans('submissions.attributes.submitted_at'),
                'class' => 'text-center',
            ]
        ];
    }

    protected function getBuilderParameters()
    {
        $data = parent::getBuilderParameters();
        $data['dom'] = '<"datatable-header"lf><"datatable-scroll"t><"datatable-footer"ip>';
        return $data;
    }

    public function forVendor($vendor)
    {
        $this->vendor = $vendor;
        return $this;
    }

    protected function filename()
    {
        return 'submission_dt_' . time();
    }
}
