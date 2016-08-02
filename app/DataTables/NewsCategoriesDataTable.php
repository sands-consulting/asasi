<?php

namespace App\DataTables;

use App\NewsCategory;

class NewsCategoriesDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function($category) {
                return view('admin.news-categories._index_actions', compact('category'));
            })
            ->editColumn('status', function($category) {
                return trans('statuses.' . $category->status);
            })
            ->make(true);
    }

    public function query()
    {
        return $this->applyScopes(NewsCategory::query());
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
                'name'  => 'news_categories.name',
                'title' => trans('news-categories.attributes.name'),
            ],
            [
                'data'  => 'status',
                'name'  => 'news_categories.status',
                'title' => trans('news.attributes.status'),
            ]
        ];
    }

    protected function filename()
    {
        return 'news_categories_dt_' . time();
    }
}
