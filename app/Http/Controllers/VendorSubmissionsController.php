<?php

namespace App\Http\Controllers;

use App\DataTables\VendorSubmissionsDataTable;
use App\EvaluationType;
use App\Notice;
use App\Submission;
use App\SubmissionDetail;
use App\Services\NoticesService;
use App\Services\SubmissionsService;
use App\Services\SubmissionDetailsService;
use App\Services\UserHistoriesService;
use App\Vendor;
use Illuminate\Http\Request;

class VendorSubmissionsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(VendorSubmissionsDataTable $table, Vendor $vendor)
    {
        $table->vendor = $vendor;
        return $table->render('vendors.submissions.index', compact('vendor'));
    }

    public function show(Vendor $vendor, Submission $submission)
    {
        $notice = $submission->notice;
        return view('vendors.submissions.show', compact('notice', 'vendor', 'submission'));
    }

    public function create(Vendor $vendor, Submission $submission, EvaluationType $type)
    {
        $notice = $submission->notice;
        return view('vendors.submissions.commercial', compact('vendor', 'submission'));
    }

    public function store()
    {

    }

    public function edit(Vendor $vendor, Submission $submission, EvaluationType $type)
    {
        $notice = $submission->notice;
        $details = $submission->details($type->id)->get();
        // Fixme: fix code to reduce query.
        $requirements = $notice->submissionRequirements()->where('type_id', $type->id)->get();

        if ($details) {

        }

        return view('vendors.submissions.edit', compact('notice', 'submission', 'type', 'requirements'));
    }

    public function update()
    {
    }

    public function myNotices(Request $request)
    {
        $vendor = $request->user()->vendor->first();
        $myNotices = $vendor->notices;

        return view('notices.my-notices', compact('vendor', 'myNotices'));
    }

    public function submission(Request $request, Notice $notice)
    {
        $vendor = $request->user()->vendor;
        // check if submission exists
        $submission = SubmissionDetail::firstOrNew([
            'vendor_id' => $vendor->id,
            'notice_id' => $notice->id,
        ]);

        return view('notices.submission', compact('notice', 'submission'));
    }

    public function commercial(Notice $notice)
    {
        $requirements = $notice->requirementCommercials;
        return view('notices.commercial', compact('notice', 'requirements'));
    }

    public function commercialEdit(Notice $notice, Submission $submission)
    {
        $details = $submission->details(1)->get();
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
        $details = $submission->details(2)->get();
        // Fixme: fix code to reduce query.
        $requirements = $notice->requirementTechnicals->map(function ($requirement, $key) use ($details) {
            $requirement->details = $details->where('requirement_id', $requirement->id)->first();
            return $requirement;
        });
        // return $requirements;

        return view('notices.technical-edit', compact('notice', 'submission', 'requirements'));
    }

    public function saveSubmission(Request $request, Notice $notice)
    {
        $input = $request->all();

        $input['vendor_id'] = $request->user()->vendor->id;
        $input['notice_id'] = $notice->id;

        // check if submission exists
        $submission = Submission::where('vendor_id', $request->user()->vendor->id)
            ->where('notice_id', $notice->id)
            ->first();

        if ( ! $submission) {
            $submission = SubmissionsService::create(new Submission, $input);
        } else {
            $submission = Submission::find($submission->id);
            $submission = SubmissionsService::update($submission, $input);
        }

        if ($input['type_id'] == 1) {
            $requirements = $notice->requirementCommercials;
        } elseif ($input['type_id'] == 2) {
            $requirements = $notice->requirementTechnicals;
        }

        // Fixme: Temp solutions
        $details = $requirements->reduce(function ($carry, $requirement) use ($input, $submission, $request) {

            $carry['value'] = null;

            if (isset($input['file'][$requirement->id])) {
                $file = $input['file'][$requirement->id];
                $carry['value'] = 1;
            }

            if ( ! $requirement->require_file) {
                if (isset($input['value'][$requirement->id])) {
                    $carry['value'] = $input['value'][$requirement->id];
                }
            }

            $carry['user_id'] = $request->user()->id;

            if ( ! isset($input['submission_detail_id'][$requirement->id])) {
                $carry['requirement_id'] = $requirement->id;
                $carry['submission_id'] = $submission->id;
                $carry['type_id'] = $input['type_id'];

                $submissionDetail = SubmissionDetailsService::create(new SubmissionDetail, $carry);
                isset($file) ? $submissionDetail->attachFiles($file) : false;
            } else {
                $submissionDetail = SubmissionDetail::find($input['submission_detail_id'][$requirement->id]);
                if ($requirement->require_file) {
                    if (isset($file)) {
                        if ($submissionDetail->files()) {
                            $submissionDetail->detachFiles();
                        }
                        $carry['value'] = 1;
                        $submissionDetail->attachFiles($file);
                    } else {
                        if ($submissionDetail->files()) {
                            $carry['value'] = 1;
                        }
                    }
                }

                SubmissionDetailsService::update($submissionDetail, $carry);
            }

        }, null);

        return redirect()
            ->route('notices.submission', $notice->id)
            ->with('notice', trans('notices.notices.submission_saved', ['number' => $notice->number]));
    }

    public function submissionSubmit(Request $request, Submission $submission)
    {
        $submission = SubmissionsService::update($submission, [
            'status'       => 'submitted',
            'submitted_at' => \Carbon\Carbon::now(),
        ]);

        return redirect()
            ->route('notices.submission-slip', $submission)
            ->with('notices', trans('notices.notices.submission_submitted', ['number' => $submission->notice->number]));
    }

    public function slip(Submission $submission)
    {
        return view('notices.submission-slip', compact('submission'));
    }

}
