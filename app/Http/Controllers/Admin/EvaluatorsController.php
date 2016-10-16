<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\EvaluatorsDataTable;
use App\Notice;
use Illuminate\Http\Request;

class EvaluatorsController extends Controller
{
    public function index(EvaluatorsDataTable $table, Notice $notice)
    {
        return $table->with('notice', $notice)->render('admin.evaluators.index', compact('notice'));
    }

    public function assign(Notice $notice)
    {
        return view('admin.evaluators.assign', compact('notice'));
    }

    public function assigned(Request $request, Notice $notice)
    {
        $inputs = $request->only('submission_id');
        $noticeEvaluator = $notice->evaluators()->where('user_id', $request->user()->id)->first();
        $noticeEvaluator->submissions()->sync($inputs['submission_id']);

        return redirect()
            ->back()
            ->with('notices', trans('evaluators.notices.assigned'));
    }
}
