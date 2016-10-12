<?php

namespace App\Http\Controllers\Admin;


use App\DataTables\EvaluationsDataTable;
use App\DataTables\EvaluationSubmissionsDataTable;
use App\EvaluationRequirement;
use App\Submission;
use App\Notice;
use Illuminate\Http\Request;

class EvaluationsController extends Controller
{
    public function index(EvaluationsDataTable $table)
    {
        return $table->render('admin.evaluations.index');
    }

    public function submissions(Request $request, EvaluationSubmissionsDataTable $table, Notice $notice)
    {
        $inputs = $request->only('type');
        return $table->byNoticeId($notice->id)
            ->byUserId($request->user()->id)
            ->forType($inputs['type'])
            ->render('admin.evaluations.submissions', compact('notice'));
    }

    public function evaluate(Notice $notice, Submission $submission)
    {
        $submissionDetails = $submission->details;
        $evaluationRequirements = EvaluationRequirement::where('evaluation_type_id', 1)->get();
        return view('admin.evaluations.evaluate', compact('notice','submission', 'submissionDetails', 'evaluationRequirements'));
    }
}
