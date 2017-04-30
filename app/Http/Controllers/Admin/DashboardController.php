<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DashboardNoticesDataTable;
use App\DataTables\DashboardUsersDataTable;
use App\DataTables\DashboardVendorsDataTable;
use App\Notice;
use App\NoticePurchase;
use App\Services\VendorService;
use App\UserHistory;
use App\UserLog;
use App\Vendor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request, DashboardUsersDataTable $table)
    {
        if ($request->user()->hasRole('Evaluator')) {
            return redirect()->route('admin.evaluations.index');
        }

        $lastLogins = UserHistory::lastLogin(4)->get();
        return $table->render('admin.dashboard.user', compact('lastLogins'));
    }

    public function user(DashboardUsersDataTable $table)
    {
        $lastLogins = UserHistory::lastLogin(4)->get();
        return $table->render('admin.dashboard.user', compact('lastLogins'));
    }

    public function vendor(DashboardVendorsDataTable $table)
    {
        // return NoticePurchase::groupBylimit(5)->get();
        $topPurchasers = VendorService::purchaseCount(5);
        return $table->render('admin.dashboard.vendor', compact('topPurchasers'));
    }

    public function notice(DashboardNoticesDataTable $table)
    {
        $notices = Notice::all();
        return $table->render('admin.dashboard.notice', compact('notices'));
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
