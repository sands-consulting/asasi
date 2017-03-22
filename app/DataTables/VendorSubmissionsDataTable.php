<?php

namespace App\DataTables;

use App\Libraries\Carbon;
use App\NoticePurchase;

class VendorSubmissionsDataTable extends DataTable
{
    public $vendor;

    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('submission_at', function ($notice) {
                return Carbon::parse($notice->submission_at)->formatDateFromSetting();
            })
            ->editColumn('submitted_at', function ($notice) {
                return ! is_null($notice->submitted_at)
                    ? Carbon::parse($notice->submitted_at)->formatDateFromSetting()
                    : '<span class="icon-cross3"></span>';
            })
            ->addColumn('action', function ($submission) {
                // return view('admin.submissions._index_actions', compact('submission'));
            })
            ->make(true);
    }

    public function query()
    {
        $query = NoticePurchase::query()
            ->leftJoin('vendors', 'vendors.id', '=', 'notice_purchases.id')
            ->leftJoin('notices', 'notices.id', '=', 'notice_purchases.notice_id')
            ->leftJoin('submissions', 'submissions.purchase_id', '=', 'notice_purchases.id')
            ->where('notice_purchases.vendor_id', $this->vendor->id);

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
                'data'  => 'name',
                'name'  => 'notices.name',
                'title' => trans('notices.attributes.name'),
                'width' => '40%',
            ],
            [
                'data'  => 'submission_at',
                'name'  => 'notices.submission_at',
                'title' => trans('notices.attributes.submission_at'),
                'class' => 'text-center',
            ],
            [
                'data'  => 'submitted_at',
                'name'  => 'submissions.submitted_at',
                'title' => trans('submissions.attributes.created_at'),
                'class' => 'text-center',
            ],
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
