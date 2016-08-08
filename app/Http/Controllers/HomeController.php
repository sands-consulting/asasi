<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
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
    public function index()
    {
        if(!$vendor = Auth::user()->vendor) {
            return redirect()
                ->route('vendors.create')
                ->with('notice', trans('vendors.notices.public.no-vendor'));
        }
        return view('home.index', ['vendor' => $vendor]);
    }
}
