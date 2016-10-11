<?php

namespace App\Http\Controllers\Admin;


use App\DataTables\EvaluationsDataTable;
use App\DataTables\EvaluationSubmissionsDataTable;
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
        return $table->forType($inputs['type'])->render('admin.evaluations.submissions', compact('notice'));
    }

    public function evaluate(Submission $submission)
    {
        $submissionDetails = $submission->details;
        return view('admin.evaluations.evaluate', compact('submission', 'submissionDetails'));
    }
}
