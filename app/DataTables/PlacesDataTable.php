<?php

namespace App\DataTables;

use App\Place;

class PlacesDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function($place) {
                return view('admin.places._index_actions', compact('place'));
            })
            ->editColumn('name', function($place) {
                return link_to_route('admin.places.show', $place->name, $place->id);
            })
            ->editColumn('status', function($place) {
                return view('admin.places._index_status', compact('place'));
            })
            ->editColumn('type', function($place) {
                return trans('places.types.' . $place->type);
            })
            ->addColumn('parent_name', function($place) {
                return view('admin.places._index_parent', compact('place'));
            })
            ->make(true);
    }

    public function query()
    {
        $query = Place::leftJoin('places as parent', 'places.parent_id', '=', 'parent.id')->select('places.*');

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
                'name'  => 'places.name',
                'title' => trans('places.attributes.name'),
            ],
            [
                'data'  => 'type',
                'name'  => 'places.type',
                'title' => trans('places.attributes.type'),
            ],
            [
                'data'  => 'parent_name',
                'name'  => 'parent.name',
                'title' => trans('places.attributes.parent')
            ],
            [
                'data'  => 'status',
                'name'  => 'places.status',
                'title' => trans('places.attributes.status'),
            ]
        ];
    }

    protected function filename()
    {
        return 'places_dt_' . time();
    }


    protected function getBuilderParameters()
    {
        $data = parent::getBuilderParameters();
        $data['dom'] = '<"datatable-header"l><"datatable-scroll"t><"datatable-footer"ip>';
        return $data;
    }
}
