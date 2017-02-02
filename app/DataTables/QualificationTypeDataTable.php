<?php

namespace App\DataTables;

use App\QualificationType;

class QualificationTypeDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function($type) {
                return view('admin.qualification-code-types._index_actions', compact('type'));
            })
            ->editColumn('name', function($type) {
                $names = [];

                foreach($type->getAncestorsAndSelf() as $type)
                {
                    $names[] = $type->name;
                }

                return implode(' > ' , $names);
            })
            ->editColumn('status', function($type) {
                return view('admin.qualification-code-types._index_status', compact('type'));
            })
            ->editColumn('created_at', function($type) {
                return $type->created_at->format('d/m/Y H:i:s');
            })
            ->make(true);
    }

    public function query()
    {
        $query = QualificationType::query();

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
                'data'  => 'name',
                'name'  => 'qualification_code_types.name',
                'title' => trans('qualification-code-types.attributes.name'),
            ],
            [
                'data'  => 'status',
                'name'  => 'qualification_code_types.status',
                'title' => trans('qualification-code-types.attributes.status'),
            ],
            [
                'data'  => 'created_at',
                'name'  => 'qualification_code_types.created_at',
                'title' => trans('qualification-code-types.attributes.created_at')
            ]
        ];
    }

    protected function filename()
    {
        return 'qualification_code_types_dt_' . time();
    }
}
