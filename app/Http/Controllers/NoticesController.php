<?php

namespace App\Http\Controllers;

use App\Notice;
use App\Submission;
use App\SubmissionDetail;
use App\Http\Requests\NoticeRequest;
use App\Repositories\NoticesRepository;
use App\Repositories\SubmissionsRepository;
use App\Repositories\SubmissionDetailsRepository;
use App\Repositories\UserLogsRepository;
use Auth;
use Illuminate\Http\Request;

class NoticesController extends Controller
{
    public function index(NoticesDataTable $table)
    {
        return $table->render('admin.notices.index');
    }

    public function show(Notice $notice)
    {
        $vendorAwarded = $notice->vendors()->awarded()->first();
        return view('notices.show', compact('notice', 'vendorAwarded'));
    }
}
