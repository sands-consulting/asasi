<?php

namespace App\Http\Controllers;

use App\Notice;
use App\Http\Requests\NoticeRequest;
use App\Repositories\NoticesRepository;
use App\Repositories\UserLogsRepository;
use Auth;
use Illuminate\Http\Request;

class NoticesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(NoticesDataTable $table)
    {
        return $table->render('admin.notices.index');
    }

    public function myNotices()
    {
        $vendor = Auth::user()->vendor;
        $myNotices = $vendor->notices;

        return view('notices.my-notices', compact('myNotices'));
    }
}
