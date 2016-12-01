<?php

namespace App\DataTables;

use App\Notice;

class DashboardInvitationsDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function($notice) {
                return view('notices._index_actions', compact('notice'));
            })
            ->editColumn('name', function($notice) {
                return link_to_route('notices.show', $notice->name, $notice->id);
            })
            ->editColumn('status', function($notice) {
                return view('notices._index_status', compact('notice'));
            })
            ->make(true);
    }

    public function query()
    {
        $query = Notice::leftJoin('notice_invitation', 'notice_invitation.id', '=', 'notices.id')
            ->where('notice_invitation.vendor_id', $this->vendor_id)
            ->limited();

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
                'data' => 'name',
                'name' => 'name',
                'title' => trans('notices.attributes.name'),
                'width' => '40%'
            ],
            [
                'data' => 'expired_at',
                'name' => 'expired_at',
                'title' => trans('notices.attributes.expired_at'),
                'width' => '15%'
            ]
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
