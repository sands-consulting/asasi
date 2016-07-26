<?php

namespace App\DataTables;

class RevisionsDataTable extends DataTable
{
    protected $revisionable;

    public function setRevisionable($revisionable)
    {
        $this->revisionable = $revisionable;
    }

    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('old_value', function($revision) {
                $string = wordwrap($revision->old_value, 20, "<br>\n", true);
                return blank_icon($string);
            })
            ->editColumn('new_value', function($revision) {
                $string = wordwrap($revision->new_value, 20, "<br>\n", true);
                return blank_icon($string);
            })
            ->editColumn('created_at', function($revision) {
                return $revision->created_at->format('d/m/Y H:i:s');
            })
            ->addColumn('user', function($revision) {
                if($revision->userResponsible())
                {
                    return $revision->userResponsible()->name;
                }
                else
                {
                    return trans('revisions.attributes.system');
                }
            })
            ->make(true);
    }

    public function query()
    {
        $query = $this->revisionable->revisionHistory();
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
                'data'  => 'key',
                'title' => trans('revisions.attributes.key')
            ],
            [
                'data'  => 'old_value',
                'title' => trans('revisions.attributes.old_value'),
            ],
            [
                'data'  => 'new_value',
                'title' => trans('revisions.attributes.new_value'),
            ],
            [
                'data'          => 'user',
                'title'         => trans('revisions.attributes.user'),
                'searchable'    => false,
                'orderable'     => false
            ],
            [
                'data'  => 'created_at',
                'title' => trans('revisions.attributes.created_at'),
            ],
        ];
    }

    protected function filename()
    {
        return 'revisions_dt_' . time();
    }
}
