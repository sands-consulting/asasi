<?php

namespace App\DataTables\Portal;

use App\Notice;

class EligiblesDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function ($notice) {
                return view('notices.index.actions', compact('notice'));
            })
            ->editColumn('name', function ($notice) {
                return view('notices.index.name', compact('notice'));
            })
            ->make(true);
    }

    public function query()
    {
        $query = Notice::published();
        $query = $query->whereHas('eligibles', function($query) {
            $query->where('vendor_id', $this->vendor_id);
        });

        if ($this->datatables->request->input('q', null))
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
                'width' => '30%'
            ],
            [
                'data' => 'purchased_at',
                'name' => 'purchased_at',
                'title' => trans('notices.attributes.purchased_at'),
                'width' => '15%'
            ],
            [
                'data' => 'expired_at',
                'name' => 'expired_at',
                'title' => trans('notices.attributes.expired_at'),
                'width' => '15%'
            ],
            [
                'data' => 'price',
                'name' => 'price',
                'title' => trans('notices.attributes.price'),
                'width' => '10%'
            ]
        ];
    }

    protected function filename()
    {
        return 'portal_eligibles_dt_' . time();
    }

    protected function getBuilderParameters()
    {
        $data = parent::getBuilderParameters();
        $data['dom'] = '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>';
        $data['autoWidth'] = false;
        return $data;
    }
}
