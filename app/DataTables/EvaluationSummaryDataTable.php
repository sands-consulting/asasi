<?php

namespace App\DataTables;

use App\Notice;
use App\Submission;

class EvaluationSummaryDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            // ->addColumn('action', function($notice) {
            //     return view('admin.notices._index_actions', compact('notice'));
            // })
            ->editColumn('name', function($vendor) {
                return link_to_route('admin.vendors.show', $vendor->name, $vendor->id);
            })
            // ->editColumn('status', function($notice) {
            //     return view('admin.notices._index_status', compact('notice'));
            // })
            ->make(true);
    }

    public function query()
    {
        $select = [
            'vendors.id as vendor_id',
            'vendors.name as vendor_name',
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

        // $query = Notice::query()
        //     ->leftJoin('notice_vendor', 'notice_vendor.notice_id', '=', 'notices.id')
        //     ->leftJoin('vendors', 'vendors.id', '=', 'notice_vendor.vendor_id')
        //     ->leftJoin('submissions', function($join) {
        //         $join->on('submissions.notice_id', '=', 'notices.id');
        //         $join->on('submissions.vendor_id', '=', 'vendors.id');
        //     })
        //     ->where('notices.id', '=', $this->notice_id)
        //     ->groupBy('notices.id');

        // $select = [
        //     'vendors.id as vendor_id',
        //     'vendors.name as vendor_name',
        //     'submissions.price as submission_price',
        // ];
        
        // foreach($this->types as $type) {  
        //     $reqAlias   = $type->name . '_req';
        //     $scoreAlias = $type->name . '_score';

        //     $query->leftJoin('evaluation_requirements as ' . $reqAlias, $reqAlias . '.notice_id', '=', 'notices.id')
        //         ->leftJoin('evaluation_scores as ' . $scoreAlias, function($join) use ($scoreAlias, $reqAlias) {
        //             $join->on($scoreAlias . '.evaluation_requirement_id', '=', $reqAlias . '.id');
        //             $join->on($scoreAlias . '.submission_id', '=', 'submissions.id');
        //         })
        //         ->where($reqAlias . '.evaluation_type_id', $type['id'])
        //         ->groupBy($reqAlias . '.evaluation_type_id');

        //     array_push(
        //         $select, 
        //         \DB::raw("FORMAT((SUM(" . $scoreAlias . ".score) / SUM(" . $reqAlias . ".full_score)) * 100, 2) as " 
        //             . $type->name . '_score')
        //     );

        //     array_push(
        //         $select, 
        //         \DB::raw("SUM(" . $scoreAlias . ".score) as " . $type->name . '_sum')
        //     );
        // }
        // $query->select($select);
        // $query->leftJoin('evaluation_types', 'evaluation_types.id', '=', 'evaluation_requirements.evaluation_type_id');


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
                    ->addAction(['width' => '5%', 'class' => 'text-center'])
                    ->parameters($this->getBuilderParameters());
    }

    protected function getColumns()
    {
        $columns[] = [
            'data' => 'vendor_name',
            'name' => 'vendor_name',
            'title' => trans('vendors.attributes.name'),
            'width' => '40%'
        ];

        $columns[] = [
            'data' => 'submission_price',
            'name' => 'submission_price',
            'title' => trans('submissions.attributes.price'),
            'width' => '40%'
        ];

        foreach($this->types as $type) {
            $columns[] = [
                'data' => $type->name . '_score',
                'name' => $type->name . '_score',
                'title' => ucfirst($type->name) . ' Average Score (%)',
                'width' => '40%'
            ];
            $columns[] = [
                'data' => $type->name . '_sum',
                'name' => $type->name . '_sum',
                'title' => ucfirst(($type->name)) . (' Total Score'),
                'width' => '40%'
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
