<?php

namespace App\DataTables;

use App\Notice;
use DB;

class NoticeEventsDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('event_at', function($event) {
                return $event->event_at->formatDateTimeFromSetting();
            })
            ->make(true);
    }

    public function query()
    {
        $query = $this->notice->events()
                ->select([
                    'notice_events.name',
                    DB::raw('notice_event_types.name as type'),
                    'notice_events.location',
                    'notice_events.event_at'
                ])
                ->join('notice_event_types', 'notice_events.notice_event_type_id', '=', 'notice_event_types.id');

        return $this->applyScopes($query);
    }

    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->ajax('')
                    ->parameters($this->getBuilderParameters());
    }

    protected function getColumns()
    {
        return [
            [
                'data'  => 'notice_event_types.name',
                'name'  => 'type',
                'title' => trans('notices.views.events.table.type'),
                'width' => '15%'
            ],
            [
                'data'  => 'notice_events.event_at',
                'name'  => 'event_at',
                'title' => trans('notices.views.events.table.event_at'),
                'width' => '25%'
            ],
            [
                'data'  => 'notice_events.name',
                'name'  => 'name',
                'title' => trans('notices.views.events.table.name'),
                'width' => '30%'
            ],
            [
                'data'  => 'notice_events.location',
                'name'   => 'location',
                'title' => trans('notices.views.events.table.location'),
                'width' => '30%'
            ]
        ];
    }

    protected function filename()
    {
        return 'notice_events_dt_' . time();
    }

    protected function getBuilderParameters()
    {
        $data = parent::getBuilderParameters();
        $data['dom'] = '<"datatable-header"l><"datatable-scroll"t><"datatable-footer"ip>';
        $data['autoWidth'] = false;
        return $data;
    }
}
