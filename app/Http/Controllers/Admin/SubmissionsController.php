<?php

namespace App\Http\Controllers\Admin;

use App\Submission;
use App\Notice;
use App\DataTables\SubmissionsDataTable;
use App\DataTables\SubmissionNoticesDataTable;
use App\DataTables\RevisionsDataTable;
use App\Http\Requests\SubmissionRequest;
use App\Services\SubmissionsService;
use Illuminate\Http\Request;

class SubmissionsController extends Controller
{
    public function index(SubmissionNoticesDataTable $table)
    {
        return $table->render('admin.submissions.index');
    }

    public function lists(Notice $notice)
    {
        $submissions = $notice->submissions;
        return view('admin.submissions.lists', compact('notice', 'submissions'));
    }

    public function create(Request $request)
    {
        return view('admin.submissions.create', ['submission' => new Submission]);
    }

    public function store(SubmissionRequest $request)
    {
        $inputs = $request->only('name');

        $submission  = SubmissionsService::create(new Submission, $inputs);
        return redirect()
            ->route('admin.submissions.show', $submission->id)
            ->with('notice', trans('submissions.notices.created', ['name' => $submission->name]));
    }

    public function show(Submission $submission)
    {
        return view('admin.submissions.show', compact('submission'));
    }

    public function edit(Submission $submission)
    {
        return view('admin.submissions.edit', compact('submission'));
    }

    public function update(SubmissionRequest $request, Submission $submission)
    {
        $inputs = $request->only(
            'name'
        );
        
        $submission  = SubmissionsService::update($submission, $inputs);
        return redirect()
            ->route('admin.submissions.show', $submission->id)
            ->with('notice', trans('submissions.notices.updated', ['name' => $submission->name]));
    }

    public function destroy(Submission $submission)
    {
        SubmissionsService::delete($submission);
        return redirect()
            ->route('admin.submissions.index')
            ->with('notice', trans('submissions.notices.deleted', ['name' => $submission->name]));
    }

    public function logs(Submission $submission, SubmissionLogsDataTable $table)
    {
        $table->setActionable($submission);
        return $table->render('admin.submissions.logs', compact('submission'));
    }

    public function revisions(Submission $submission, RevisionsDataTable $table)
    {
        $table->setRevisionable($submission);
        return $table->render('admin.submissions.revisions', compact('submission'));
    }

    public function activate(Request $request, Submission $submission)
    {
        SubmissionsService::activate($submission);
        return redirect()
            ->to($request->input('redirect_to', route('admin.submissions.show', $submission->id)))
            ->with('notice', trans('submissions.notices.activated', ['name' => $submission->name]));
    }

    public function deactivate(Request $request, Submission $submission)
    {
        SubmissionsService::deactivate($submission);
        return redirect()
            ->to($request->input('redirect_to', route('admin.submissions.show', $submission->id)))
            ->with('notice', trans('submissions.notices.deactivated', ['name' => $submission->name]));
    }

    public function evaluate(Submission $submission)
    {
        $submissionDetails = $submission->details;
        return view('admin.submissions.evaluate', compact('submission', 'submissionDetails'));
    }
}
