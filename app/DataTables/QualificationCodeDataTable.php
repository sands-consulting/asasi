<?php

namespace App\DataTables;

use App\QualificationCode;

class QualificationCodeDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function($code) {
                return view('admin.qualification-codes._index_actions', compact('code'));
            })
            ->editColumn('type', function($code) {
                return $code->type->name;
            })
            ->editColumn('status', function($code) {
                return view('admin.qualification-codes._index_status', compact('code'));
            })
            ->editColumn('created_at', function($code) {
                return $code->created_at->format('d/m/Y H:i:s');
            })
            ->make(true);
    }

    public function query()
    {
        $query = QualificationCode::with('type');

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
                'data'  => 'code',
                'name'  => 'qualification_codes.code',
                'title' => trans('qualification-codes.attributes.code'),
            ],
            [
                'data'  => 'name',
                'name'  => 'qualification_codes.name',
                'title' => trans('qualification-codes.attributes.name'),
            ],
            [
                'data'  => 'type',
                'name'  => 'type.name',
                'title' => trans('qualification-codes.attributes.type'),
            ],
            [
                'data'  => 'status',
                'name'  => 'qualification_codes.status',
                'title' => trans('qualification-codes.attributes.status'),
            ],
            [
                'data'  => 'created_at',
                'name'  => 'qualification_codes.created_at',
                'title' => trans('qualification-codes.attributes.created_at')
            ]
        ];
    }

    protected function filename()
    {
        return 'qualification_codes_dt_' . time();
    }
}
