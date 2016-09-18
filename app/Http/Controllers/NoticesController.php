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
        $input              = $request->only('value', 'price', 'file');
        $input['type']      = 'commercial';
        $input['vendor_id'] = Auth::user()->vendor->id;
        $input['notice_id'] = $notice->id;

        $submission = SubmissionsRepository::create(new Submission, $input);

        // Fixme: Temp solutions
        $details = $notice->requirementCommercials->reduce(function($carry, $requirement) use ($input, $submission) {

            $file = isset($input['file'][$requirement->id]) ? $input['file'][$requirement->id] : null;
            $carry['value'] = isset($input['value'][$requirement->id]) ? $input['value'][$requirement->id] : null;
            $carry['requirement_id'] = $requirement->id;
            $carry['submission_id'] = $submission->id;
            $carry['user_id'] = Auth::user()->id;

            $SubmissionDetail = SubmissionDetailsRepository::create(new SubmissionDetail, $carry);
            $SubmissionDetail->attachFiles($file);

        }, null);

        return redirect()
            ->route('notices.submission', $notice->id)
            ->with('notice', trans('notices.notices.submission_saved'));
    }

    public function technical(Notice $notice)
    {
        $requirements = $notice->requirementTechnicals;
        return view('notices.technical', compact('notice', 'requirements'));
    }

    public function storeTechnical(Request $request, Notice $notice)
    {
        $input              = $request->only('value', 'file');
        $input['type']      = 'technical';
        $input['vendor_id'] = Auth::user()->vendor->id;
        $input['notice_id'] = $notice->id;

        $submission = SubmissionsRepository::create(new Submission, $input);

        // Fixme: Temp solutions
        $details = $notice->requirementTechnicals->reduce(function($carry, $requirement) use ($input, $submission) {

            $file = isset($input['file'][$requirement->id]) ? $input['file'][$requirement->id] : null;
            $carry['value'] = isset($input['value'][$requirement->id]) ? $input['value'][$requirement->id] : null;
            $carry['requirement_id'] = $requirement->id;
            $carry['submission_id'] = $submission->id;
            $carry['user_id'] = Auth::user()->id;

            $SubmissionDetail = SubmissionDetailsRepository::create(new SubmissionDetail, $carry);
            $SubmissionDetail->attachFiles($file);

        }, null);

        return redirect()
            ->route('notices.submission', $notice->id)
            ->with('notice', trans('notices.notices.submission_saved'));
    }
}
