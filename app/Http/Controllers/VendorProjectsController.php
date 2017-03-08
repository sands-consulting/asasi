<?php

namespace App\Http\Controllers;

use Auth;
use App\Project;
use App\Vendor;
use Illuminate\Http\Request;

class VendorProjectsController extends Controller
{
    public function index(Vendor $vendor, Request $request)
    {
        return view('vendors.projects.index');
    }

    public function show(Vendor $vendor, User $user)
    {
        return view('vendors.users.show', compact('vendor'));
    }
}
