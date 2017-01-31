<?php

namespace App\DataTables;

use Yajra\Datatables\Services\DataTable as DataTableService;

abstract class DataTable extends DataTableService
{
    protected $user;

    public function setUser($user)
    {
        $this->user = $user;
    }

	protected function getBuilderParameters()
    {
        return [
            'dom' => '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
            'language' => [
            	'search' => '<span>Filter:</span> _INPUT_',
            	'lengthMenu' => '<span>Show:</span> _MENU_',
            	'paginate' => [
            		'first' => 'First',
            		'last' => 'Last',
            		'next' => '&rarr;',
            		'previous' => '&larr;'
            	],
            ]
        ];
    }
}