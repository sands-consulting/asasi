<?php

namespace App\Http\Controllers;

use App\Http\Requests;
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
    public function index(Request $request)
    {
        if (!!Auth::user()->hasPermission('access:admin')) {
            return redirect()
                ->route('admin');
        } elseif (!$vendor = Auth::user()->vendor) {
            return redirect()
                ->route('vendors.create')
                ->with('notice', trans('vendors.notices.public.no-vendor'));
        }

        $type = $request->get('type', 1);
        $notice_types = Notice::published()->distinct('notice_type_id')->get();
        $notices = Notice::published()->whereNoticeTypeId($type)->get();

        return view('dashboard.index', compact('vendor', 'notices', 'notice_types', 'type'));
    }
}
