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
        // check if submission exists
        $submissions['commercial'] = Submission::where('vendor_id', Auth::user()->vendor->id)
            ->where('type', 'commercial')
            ->first();
        $submissions['technical'] = Submission::where('vendor_id', Auth::user()->vendor->id)
            ->where('type', 'technical')
            ->first();

        return view('notices.submission', compact('notice', 'submissions'));
    }

    public function commercial(Notice $notice)
    {
        $requirements = $notice->requirementCommercials;
        return view('notices.commercial', compact('notice', 'requirements'));
    }

    public function commercialEdit(Notice $notice, Submission $submission)
    {
        $details = $submission->details;
        // return $details = $submission->details()->where('requirement_id', 2)->first(['value']);
        // Fixme: fix code to reduce query.
        $requirements = $notice->requirementCommercials->map(function ($requirement, $key) use ($details) {
            $requirement->details = $details->where('requirement_id', $requirement->id)->first();
            return $requirement;
        });

        return view('notices.commercial-edit', compact('notice', 'submission', 'requirements'));
    }


    public function technical(Notice $notice)
    {
        $requirements = $notice->requirementTechnicals;
        return view('notices.technical', compact('notice', 'requirements'));
    }

    public function technicalEdit(Notice $notice, Submission $submission)
    {
        $details = $submission->details;
        // Fixme: fix code to reduce query.
        $requirements = $notice->requirementTechnicals->map(function ($requirement, $key) use ($details) {
            $requirement->details = $details->where('requirement_id', $requirement->id)->first();
            return $requirement;
        });

        return view('notices.technical-edit', compact('notice', 'submission', 'requirements'));
    }

    public function saveSubmission(Notice $notice, Request $request)
    {
        $input = $request->only(
            'type',
            'price', 
            'submission_id',
            'submission_detail_id',
            'value', 
            'file'
        );

        $input['vendor_id'] = Auth::user()->vendor->id;
        $input['notice_id'] = $notice->id;

        if (!isset($input['submission_id'])) {
            $submission = SubmissionsRepository::create(new Submission, $input);
        } else {
            $submission = Submission::find($input['submission_id']);
            $submission = SubmissionsRepository::update($submission, $input);
        }

        // Fixme: Temp solutions
        $details = $notice->requirementCommercials->reduce(function($carry, $requirement) use ($input, $submission) {

            $file = isset($input['file'][$requirement->id]) ? $input['file'][$requirement->id] : null;
            $carry['value'] = isset($input['value'][$requirement->id]) ? $input['value'][$requirement->id] : null;
            $carry['user_id'] = Auth::user()->id;

            if (!isset($input['submission_detail_id'][$requirement->id])) {
                $carry['requirement_id'] = $requirement->id;
                $carry['submission_id'] = $submission->id;
                
                $submissionDetail = SubmissionDetailsRepository::create(new SubmissionDetail, $carry);
                $submissionDetail->attachFiles($file);
            } else {
                $submissionDetail = SubmissionDetail::find($input['submission_detail_id'][$requirement->id]);
                SubmissionDetailsRepository::update($submissionDetail, $carry);
                $submissionDetail->attachFiles($file);
            }

        }, null);

        return redirect()
            ->route('notices.submission', $notice->id)
            ->with('notice', trans('notices.notices.submission_saved'));
    }
}
