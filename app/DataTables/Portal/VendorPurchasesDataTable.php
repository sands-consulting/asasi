<?php

namespace App\DataTables\Portal;

use App\Notice;

class VendorPurchasesDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function($notice) {
                return view('notices.index.actions', compact('notice'));
            })
            ->editColumn('expired_at', function($notice) {
                return $notice->expired_at->format('d/m/Y H:i:s');
            })
            ->editColumn('name', function($notice) {
                return view('notices.index.name', compact('notice'));
            })
            ->make(true);
    }

    public function query()
    {
        $query = Notice::whereHas('purchases', function($query) {
                $query->where('vendor_id', $this->vendor_id);
            })->with('organization');

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
                    ->addAction(['width' => '10%', 'class' => 'text-center'])
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
        $data['dom'] = '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>';
        $data['autoWidth'] = false;
        return $data;
    }

    public function forVendor($vendorId)
    {
        $this->vendor_id = $vendorId;
        return $this;
    }
}
