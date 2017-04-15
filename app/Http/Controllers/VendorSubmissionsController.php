<?php

namespace App\Http\Controllers;

use App\DataTables\Portal\VendorSubmissionsDataTable;
use App\EvaluationType;
use App\Libraries\Carbon;
use App\Notice;
use App\Services\SubmissionItemService;
use App\Submission;
use App\SubmissionDetail;
use App\Services\NoticesService;
use App\Services\SubmissionsService;
use App\Services\SubmissionDetailService;
use App\Services\UserHistoriesService;
use App\SubmissionItem;
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

    public function create(Vendor $vendor, Submission $submission, SubmissionDetail $details)
    {
        $notice = $submission->notice;
        $requirements = $notice->submissionRequirements()->where('type_id', $details->type_id)->get();
        return view('vendors.submissions.create', compact('vendor', 'requirements', 'submission', 'type'));
    }

    public function edit(Vendor $vendor, Submission $submission, SubmissionDetail $detail)
    {
        $notice = $submission->notice;
        $items = $detail->items;
        $items->load('files');

        // Fixme: fix code to reduce query.
        $requirements = $notice->submissionRequirements()->where('type_id', $detail->type_id)->get();
        $requirements->map(function ($requirement) use ($items) {
            $requirement->items = $items->where('requirement_id', $requirement->id)->first();
            return $requirement;
        });

        return view('vendors.submissions.edit', compact('notice', 'submission', 'detail', 'requirements'));
    }

    public function update(Request $request, Vendor $vendor, Submission $submission, SubmissionDetail $detail)
    {
        $incomplete = false;
        $input = $request->all();
        $input['vendor_id'] = $vendor->id;
        $input['notice_id'] = $submission->notice->id;

        // check if submission exists
        $requirements = $submission->notice
            ->submissionRequirements()
            ->where('type_id', $detail->type_id)
            ->get();

        // Fixme: Temp solutions
        $requirements->map(function ($requirement) use ($input, $detail, $request) {
            $data['value'] = null;

            $item = SubmissionItem::where('requirement_id', $requirement->id)->first();

            if (! $requirement->require_file) {
                if (isset($input['value'][$requirement->id])) {
                    $data['value'] = $input['value'][$requirement->id];
                }
            }

            if (! $item) {
                $data['requirement_id'] = $requirement->id;
                $data['detail_id'] = $detail->id;

                $item = SubmissionItemService::create(new SubmissionItem, $data);
            } else {
                if ($requirement->field_type == 'file') {
                    if ($request->hasFile('file.' . $requirement->id)) {
                        SubmissionItemService::files(
                            $item,
                            $request->file('file.' . $requirement->id)
                        );
                        $data['value'] = 1;
                    }
                }
                $item = SubmissionItemService::update($item, $data);
            }

            if ($requirement->field_required == 1 && $item->value == null) {
                $requirement->incomplete = true;
            }

        }, null);

        foreach ($requirements as $requirement) {
            if (! $requirement->incomplete) {
                SubmissionDetailService::update($detail, [
                    'completed_at' => Carbon::now(),
                    'status'       => 'completed',
                ]);
            }
        }
        // update submission detail status


        return redirect()
            ->route('vendors.submissions.show', [$vendor->id, $submission->id])
            ->with('notice', trans('notices.notices.submission_saved', ['number' => $submission->notice->number]));
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
