<?php

namespace App\DataTables;

use App\Notice;
use App\Submission;

class EvaluationSummaryDataTable extends DataTable
{
    public function ajax()
    {
        $dt = $this->datatables
            ->eloquent($this->query())
            ->editColumn('vendor_name', function($vendor) {
                return link_to_route('admin.vendors.show', $vendor->vendor_name, $vendor->vendor_id);
            });

        foreach($this->types as $type) {
            $dt->editColumn($type->name . '_score', function($vendor) use ($type) {
                return link_to_route('admin.notices.summary-evaluators', $vendor->{$type->name .'_score'}, [$vendor->notice_id, $vendor->submission_id, $type->id]);
            });
            $dt->editColumn($type->name . '_sum', function($vendor) use ($type) {
                return link_to_route('admin.notices.summary-evaluators', $vendor->{$type->name .'_sum'}, [$vendor->notice_id, $vendor->submission_id, $type->id]);
            });
        }

        return $dt->make(true);
    }

    public function query()
    {
        $select = [
            'vendors.id as vendor_id',
            'vendors.name as vendor_name',
            'submissions.id as submission_id',
            'submissions.notice_id as notice_id',
            'submissions.price as submission_price',
        ];

        foreach($this->types as $type) {  
            $tblRequirement = 'evaluation_requirements';
            $tblScore = 'evaluation_scores';
            
            array_push(
               $select, 
               \DB::raw("(SELECT 
                        FORMAT((SUM({$tblScore}.score) / SUM({$tblRequirement}.full_score)) * 100, 2) as {$type->name}_score
                    FROM {$tblRequirement}
                    LEFT JOIN {$tblScore} ON {$tblScore}.evaluation_requirement_id = {$tblRequirement}.id
                    WHERE {$tblRequirement}.evaluation_type_id = {$type->id}
                        AND {$tblScore}.submission_id = submissions.id
                        AND {$tblScore}.deleted_at IS NULL) as {$type->name}_score")
            );

            array_push(
               $select, 
               \DB::raw("(SELECT SUM({$tblScore}.score)
                    FROM {$tblRequirement}
                    LEFT JOIN {$tblScore} ON {$tblScore}.evaluation_requirement_id = {$tblRequirement}.id
                    WHERE {$tblRequirement}.evaluation_type_id = {$type->id}
                        AND {$tblScore}.submission_id = submissions.id
                        AND {$tblScore}.deleted_at IS NULL) as {$type->name}_sum")
            );
       }

        $query = Submission::query()
            ->leftJoin('vendors', 'vendors.id', '=', 'submissions.vendor_id')
            ->where('submissions.notice_id', $this->notice_id)
            ->select($select);

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
                    ->parameters($this->getBuilderParameters());
    }

    protected function getColumns()
    {
        $columns[] = [
            'data' => 'vendor_name',
            'name' => 'vendor_name',
            'title' => trans('vendors.attributes.name'),
            'width' => '30%'
        ];

        $columns[] = [
            'data' => 'submission_price',
            'name' => 'submission_price',
            'title' => trans('submissions.attributes.price'),
            'width' => '10%'
        ];

        foreach($this->types as $type) {
            $columns[] = [
                'data' => $type->name . '_score',
                'name' => $type->name . '_score',
                'title' => ucfirst($type->name) . ' (%)',
            ];

            $columns[] = [
                'data' => $type->name . '_sum',
                'name' => $type->name . '_sum',
                'title' => ucfirst(($type->name)) . (' Total'),
            ];
        }

        return $columns;
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

    public function forNotice($noticeId)
    {
        $this->notice_id = $noticeId;

        return $this;
    }

    public function forType($types)
    {
        $this->types = $types;

        return $this;
    }
}
