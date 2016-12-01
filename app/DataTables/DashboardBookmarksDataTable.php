<?php

namespace App\DataTables;

use App\Bookmark;

class DashboardBookmarksDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function($bookmark) {
                return view('dashboard._bookmarks_notice_actions', compact('bookmark'));
            })
            ->editColumn('name', function($notice) {
                return link_to_route('notices.show', $notice->name, $notice->id);
            })
            ->make(true);
    }

    public function query()
    {
        $query = Bookmark::leftJoin('notices', 'notices.id', '=', 'bookmarks.bookmarkable_id')
            ->where('bookmarks.user_id', $this->user_id)
            ->where('bookmarks.bookmarkable_type', 'App\Notice')
            ->select(
                'notices.id as notice_id',
                'notices.name as notice_name',
                'notices.number as notice_number',
                'notices.expired_at as notice_expired_at',
                'notices.status as notice_status'
            );

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
                    ->addAction(['width' => '15%', 'class' => 'text-center'])
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
                'data' => 'notice_expired_at',
                'name' => 'notice_expired_at',
                'title' => trans('notices.attributes.expired_at'),
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

    public function forUser($userId)
    {
        $this->user_id = $userId;
        return $this;
    }
}
