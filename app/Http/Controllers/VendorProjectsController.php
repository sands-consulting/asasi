<?php

namespace App\Http\Controllers;

use App\DataTables\VendorProjectsDataTable;
use Auth;
use App\Project;
use App\Vendor;
use Illuminate\Http\Request;

class VendorProjectsController extends Controller
{
    public function index(Request $request, VendorProjectsDataTable $table, Vendor $vendor)
    {
        $table->setUser($request->user());
        $table->setVendor($request->user()->vendor);
        return $table->render('vendors.projects.index');
    }

    public function show(Vendor $vendor, User $user)
    {
        return view('vendors.users.show', compact('vendor'));
    }
}
