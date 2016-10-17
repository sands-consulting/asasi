<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.user');
    }

    public function user()
    {
        return view('admin.dashboard.user');
    }

    public function vendor()
    {
        return view('admin.dashboard.vendor');
    }

    public function tender()
    {
        return view('admin.dashboard.tender');
    }

    public function transaction()
    {
        return view('admin.dashboard.transaction');
    }

    public function portfolio()
    {
        return view('admin.dashboard.portfolio');
    }
}
