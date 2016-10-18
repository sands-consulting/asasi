<?php

namespace App\DataTables;

use App\Notice;

class HomeNoticesDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function($notice) {
                // return view('admin.notices._index_actions', compact('notice'));
            })
            ->addColumn('code', function() {
                return '-';
            })
            ->editColumn('name', function($notice) {
                $name  = "<span class='text-header'>$notice->number</span> <br />";
                $name .= link_to_route('admin.notices.show', $notice->name, $notice->id);
                return $name;
            })
            ->editColumn('purchased_at', function($notice) {
                return $notice->purchased_at->formatDateFromSetting();
            })
            ->editColumn('expired_at', function($notice) {
                return $notice->expired_at->formatDateFromSetting();
            })
            ->editColumn('status', function($notice) {
                // return view('admin.notices._index_status', compact('notice'));
            })
            ->removeColumn('number')
            ->make(true);
    }

    public function query()
    {
        $query = Notice::published();
        if (isset($this->type)) {
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
                'data' => 'code',
                'name' => 'code',
                'title' => 'Code',
                'width' => '15%'
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
