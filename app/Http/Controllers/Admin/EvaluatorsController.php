<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\EvaluatorsDataTable;
use App\Notice;
use App\NoticeEvaluator;
use App\User;
use Illuminate\Http\Request;

class EvaluatorsController extends Controller
{
    public function index(EvaluatorsDataTable $table, Notice $notice)
    {
        return $table->with('notice', $notice)->render('admin.evaluators.index', compact('notice'));
    }

    public function assign(NoticeEvaluator $evaluator, Notice $notice)
    {
        return view('admin.evaluators.assign', compact('evaluator', 'notice'));
    }

    public function assigned(Request $request, NoticeEvaluator $evaluator, Notice $notice)
    {
        $input = $request->only('submission_id');
        $submissionIds = $input['submission_id'];

        $submissionData = [];
        if (count($submissionIds) > 0) {
            foreach ($submissionIds as $submissionId)
            $submissionData[$submissionId] = [
                'status' => 'incomplete'
            ];
        }

        $evaluator->submissions()->sync($submissionData);

        return redirect()
            ->back()
            ->with('notices', trans('evaluators.notices.assigned'));
    }
}
