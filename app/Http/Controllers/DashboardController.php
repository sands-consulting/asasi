<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\DataTables\DashboardBookmarksDataTable;
use App\DataTables\DashboardEligiblesDataTable;
use App\DataTables\DashboardInvitationsDataTable;
use App\DataTables\DashboardProjectsDataTable;
use App\DataTables\DashboardPurchasesDataTable;
use App\Notice;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function eligibles(Request $request, DashboardEligiblesDataTable $table)
    {
        return $table->render('dashboard.eligibles');
    }

    public function invitations(Request $request, DashboardInvitationsDataTable $table)
    {
        $vendor = $request->user()->vendor;
        return $table->forVendor($vendor->id)->render('dashboard.invitations');
    }

    public function bookmarks(Request $request, DashboardBookmarksDataTable $table)
    {
        return $table->forUser($request->user()->id)->render('dashboard.bookmarks');
    }

    public function purchases(Request $request, DashboardPurchasesDataTable $table)
    {
        $vendor = $request->user()->vendor;
        return $table->forVendor($vendor->id)->render('dashboard.purchases');
    }

    public function projects(Request $request, DashboardProjectsDataTable $table)
    {
        $vendor = $request->user()->vendor;
        return $table->forVendor($vendor->id)->render('dashboard.projects');
    }
}
