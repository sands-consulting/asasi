<?php

namespace App\Http\Controllers\Admin;

use App\Permission;
use App\DataTables\PermissionsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Repositories\PermissionsRepository;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('policy');
    }

    public function index(PermissionsDataTable $table)
    {
        return $table->render('admin.permissions.index');
    }
}
