<?php

namespace App\DataTables;

use App\NoticeCategory;

class NoticeCategoriesDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function($noticeCategory) {
                return view('admin.notice-categories._index_actions', compact('noticeCategory'));
            })
            ->editColumn('name', function($noticeCategory) {
                return link_to_route('admin.notice-categories.show', $noticeCategory->name, $noticeCategory->id);
            })
            ->editColumn('status', function($noticeCategory) {
                return view('admin.notice-categories._index_status', compact('noticeCategory'));
            })
            ->make(true);
    }

    public function query()
    {
        $query = NoticeCategory::whereNotNull('name');

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
                    ->addAction(['width' => '80', 'class' => 'text-center'])
                    ->parameters($this->getBuilderParameters());
    }

    protected function getColumns()
    {
        return [
            [
                'data' => 'name',
                'name' => 'name',
                'title' => trans('notice-categories.attributes.name')
            ],
            [
                'data' => 'status',
                'name' => 'status',
                'title' => trans('notice-categories.attributes.status')
            ],
        ];
    }

    protected function filename()
    {
        return 'notice_types_dt_' . time();
    }

    protected function getBuilderParameters()
    {
        $data = parent::getBuilderParameters();
        $data['dom'] = '<"datatable-header"l><"datatable-scroll"t><"datatable-footer"ip>';
        return $data;
    }
}
