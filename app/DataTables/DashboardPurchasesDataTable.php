<?php

namespace App\DataTables;

use App\Notice;

class DashboardPurchasesDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function($notice) {
                return view('dashboard._purchases_index_actions', compact('notice'));
            })
            ->editColumn('notice_name', function($notice) {
                return link_to_route('admin.notices.show', $notice->notice_name, $notice->notice_id);
            })
            ->editColumn('status', function($notice) {
                return view('admin.notices._index_status', compact('notice'));
            })
            ->make(true);
    }

    public function query()
    {
        $query = Notice::leftJoin('notice_vendor', 'notice_vendor.notice_id', '=', 'notices.id')
            ->leftJoin('vendors', 'vendors.id', '=', 'notice_vendor.notice_id')
            ->where('vendors.id', $this->vendor_id)
            ->select([
                'notices.id as notice_id',
                'notices.name as notice_name',
                'notices.number as notice_number',
                'notices.expired_at',
                'notices.status'
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
                    ->addAction(['width' => '5%', 'class' => 'text-center'])
                    ->parameters($this->getBuilderParameters());
    }

    protected function getColumns()
    {
        return [
            [
                'data' => 'notice_name',
                'name' => 'notice_name',
                'title' => trans('notices.attributes.name'),
                'width' => '40%'
            ],
            [
                'data' => 'notice_number',
                'name' => 'notice_number',
                'title' => trans('notices.attributes.number'),
                'width' => '15%'
            ],
            [
                'data' => 'expired_at',
                'name' => 'expired_at',
                'title' => trans('notices.attributes.expired_at'),
                'width' => '15%'
            ],
            [
                'data' => 'status',
                'name' => 'status',
                'title' => trans('notices.attributes.status'),
                'width' => '15%'
            ],
        ];
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

    public function forVendor($vendorId)
    {
        $this->vendor_id = $vendorId;
        return $this;
    }
}
