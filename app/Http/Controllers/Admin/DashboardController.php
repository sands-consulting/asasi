<?php

namespace App\Http\Controllers\Admin;

use App\UserHistory;
use App\Notice;
use App\Vendor;
use App\DataTables\DashboardUsersDataTable;
use App\DataTables\DashboardVendorsDataTable;
use App\UserLog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request, DashboardUsersDataTable $table)
    {
        if ($request->user()->hasRole('Evaluator')) {
            return redirect()->route('admin.evaluations.index');
        }

        $lastLogins = UserHistory::lastLogin(5)->get();
        return $table->render('admin.dashboard.user', compact('lastLogins'));
    }

    public function user(DashboardUsersDataTable $table)
    {
        $lastLogins = UserHistory::lastLogin(5)->get();
        return $table->render('admin.dashboard.user', compact('lastLogins'));
    }

    public function vendor(DashboardVendorsDataTable $table)
    {
        $topPurchasers = Vendor::purchaseCount(5);
        return $table->render('admin.dashboard.vendor', compact('topPurchasers'));
    }

    public function tender()
    {
        $notices = Notice::all();
        return view('admin.dashboard.tender', compact('notices'));
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
