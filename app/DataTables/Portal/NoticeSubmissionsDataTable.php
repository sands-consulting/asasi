<?php

namespace App\DataTables\Portal;

use App\Notice;
use Auth;

class NoticeSubmissionsDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('name', function($notice) {
                return view('notices.index.name', compact('notice'));
            })
            ->editColumn('purchased_at', function($notice) {
                return $notice->purchased_at->formatDateFromSetting();
            })
            ->editColumn('expired_at', function($notice) {
                return $notice->expired_at->formatDateFromSetting();
            })
            ->editColumn('price', function($notice) {
                return sprintf('%s %.2f', 'MYR', $notice->price);
            })
            ->editColumn('action', function($notice) {
                return view('notices.index.actions', compact('notice'));
            })
            ->make(true);
    }

    public function query()
    {
        $query = Notice::with('organization')->published()->submissionPublished();
        
        if (isset($this->type))
        {
            $query->where('notice_type_id', $this->type);
        }

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
                    ->addAction(['width' => '20%', 'class' => 'text-center'])
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
        return 'notices_dt_' . time();
    }

    protected function getBuilderParameters()
    {
        $data = parent::getBuilderParameters();
        $data['dom'] = '<"datatable-header"lf><"datatable-scroll"t><"datatable-footer"ip>';
        $data['autoWidth'] = false;

        return $data;
    }

    public function forType($type)
    {
        $this->type = $type;

        return $this;
    }
}
