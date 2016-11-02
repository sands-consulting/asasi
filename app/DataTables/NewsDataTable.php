<?php

namespace App\DataTables;

use App\News;

class NewsDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function($news) {
                return view('admin.news._index_actions', compact('news'));
            })
            ->editColumn('title', function($news) {
                return link_to_route('admin.news.edit', $news->title, $news->slug);
            })
            ->editColumn('category', function($news) {
                return $news->category->name;
            })
            ->editColumn('organization', function($news) {
                return $news->organization->name;
            })
            ->editColumn('status', function($news) {
                return trans('statuses.' . $news->status);
            })
            ->make(true);
    }

    public function query()
    {
        $query = News::with('category', 'organization');
        $query = $query->leftJoin('news_categories', 'news.category_id', '=', 'news_categories.id');
        $query = $query->leftJoin('organizations', 'news.organization_id', '=', 'organizations.id');
        $query = $query->select('news.*');

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
        $columns = [
            [
                'data'  => 'title',
                'name'  => 'news.title',
                'title' => trans('news.attributes.title'),
            ],
            [
                'data'  => 'category',
                'name'  => 'news_categories.name',
                'title' => trans('news.attributes.category')
            ]
        ];

        if(!$this->user->hasPermission('news:organziation'))
        {
            $columns[] = [
                'data'  => 'organization',
                'name'  => 'organizations.name',
                'title' => trans('news.attributes.organization')
            ];
        }

        $columns[] = [
            'data'  => 'status',
            'name'  => 'news.status',
            'title' => trans('news.attributes.status'),
        ];

        return $columns;
    }

    protected function filename()
    {
        return 'news_dt_' . time();
    }
}
