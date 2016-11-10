<?php

namespace App\Http\Controllers\Admin;

use App\UserLog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $lastLogins = UserLog::lastLogin(5)->get();

        return view('admin.dashboard.user', compact('lastLogins'));
    }

    public function user()
    {
        $lastLogins = UserLog::lastLogin(5)->get();

        return view('admin.dashboard.user', compact('lastLogins'));
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
