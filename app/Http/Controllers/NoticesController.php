<?php

namespace App\Http\Controllers;

use App\Notice;
use App\Submission;
use App\Http\Requests\NoticeRequest;
use App\Repositories\NoticesRepository;
use App\Repositories\SubmissionsRepository;
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

    public function submission(Notice $notice)
    {
        return view('notices.submission', compact('notice'));
    }

    public function commercial(Notice $notice)
    {
        $requirements = $notice->requirementCommercials;
        return view('notices.commercial', compact('notice', 'requirements'));
    }

    public function storeCommercial(Notice $notice, Request $request)
    {
        $input              = $request->only('requirements', 'price');
        $input['type']   = 'commercial';
        $input['user_id']   = Auth::user()->id;
        $input['vendor_id'] = Auth::user()->vendor->id;
        $input['notice_id'] = $notice->id;

        return SubmissionsRepository::create(new Submission, $input);
    }

    public function technical(Notice $notice)
    {
        $requirements = $notice->requirementTechnicals;
        return view('notices.technical', compact('requirements'));
    }

    public function storeTechnical(Request $request)
    {
        return $request->all();

    }
}
