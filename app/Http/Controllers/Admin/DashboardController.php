<?php

namespace App\Http\Controllers\Admin;

use App\UserLog;
use App\Vendor;
use App\DataTables\DashboardUsersDataTable;
use App\DataTables\DashboardVendorsDataTable;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(DashboardUsersDataTable $table)
    {
        $lastLogins = UserLog::lastLogin(5)->get();

        return $table->render('admin.dashboard.user', compact('lastLogins'));
    }

    public function user(DashboardUsersDataTable $table)
    {
        $lastLogins = UserLog::lastLogin(5)->get();
        return $table->render('admin.dashboard.user', compact('lastLogins'));
    }

    public function vendor(DashboardVendorsDataTable $table)
    {
        $topPurchasers = Vendor::purchaseCount();
        return $table->render('admin.dashboard.vendor', compact('topPurchasers'));
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
