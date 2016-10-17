<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\DataTables\DashboardDataTable;
use App\DataTables\NoticeEligibleDataTable;
use App\DataTables\NoticePurchasedDataTable;
use App\DataTables\NoticeLimitedDataTable;
use App\Notice;
use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, DashboardDataTable $table)
    {
        $type = $request->get('type', 1);
        $notice_types = Notice::published()->distinct('notice_type_id')->get();
        $notices = Notice::published()->whereNoticeTypeId($type)->get();

        // return view('dashboard.index', compact('vendor', 'notices', 'notice_types', 'type'));
        return $table->render('dashboard.index', compact('vendor', 'notices', 'notice_types', 'type'));
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function eligible(Request $request, NoticeEligibleDataTable $table)
    {
        $type = $request->get('type', 1);
        $notice_types = Notice::published()->distinct('notice_type_id')->get();
        $notices = Notice::published()->whereNoticeTypeId($type)->get();

        // return view('dashboard.index', compact('vendor', 'notices', 'notice_types', 'type'));
        return $table->render('dashboard.eligible', compact('vendor', 'notices', 'notice_types', 'type'));
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function purchased(Request $request, NoticePurchasedDataTable $table)
    {
        $type = $request->get('type', 1);
        $notice_types = Notice::published()->distinct('notice_type_id')->get();
        $notices = Notice::published()->whereNoticeTypeId($type)->get();

        // return view('dashboard.index', compact('vendor', 'notices', 'notice_types', 'type'));
        return $table->render('dashboard.purchased', compact('vendor', 'notices', 'notice_types', 'type'));
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function limited(Request $request, NoticeLimitedDataTable $table)
    {
        $type = $request->get('type', 1);
        $notice_types = Notice::published()->distinct('notice_type_id')->get();
        $notices = Notice::published()->whereNoticeTypeId($type)->get();

        // return view('dashboard.index', compact('vendor', 'notices', 'notice_types', 'type'));
        return $table->render('dashboard.limited', compact('vendor', 'notices', 'notice_types', 'type'));
        
    }

}
