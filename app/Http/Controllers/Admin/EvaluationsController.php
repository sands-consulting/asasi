<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\EvaluationsDataTable;
use App\Evaluation;
use App\EvaluationRequirement;
use App\Services\EvaluationScoresService;
use App\Services\EvaluationService;
use Illuminate\Http\Request;

class EvaluationsController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.evaluations.index');
    }

    public function show(Evaluation $evaluation)
    {
        return view('admin.evaluations.show', compact('evaluation'));
    }

    public function edit(Request $request, Evaluation $evaluation)
    {
        return view('admin.evaluations.edit', compact('evaluation'));
    }

    public function update(Request $request, Evaluation $evaluation)
    {
        $inputs = $request->get('evaluations');

        foreach($inputs as $requirementId => $data) {
            $score = $evaluation->scores()->firstOrNew([
                'requirement_id' => $requirementId
            ]);
            $score->score = !empty($data['score']) ? (int) $data['score'] : null;
            $score->remarks = !empty($data['remarks']) ? $data['remarks'] : null;
            $score->save();
        }

        $requirementCount = EvaluationRequirement::whereTypeId($evaluation->type_id)
            ->whereNoticeId($evaluation->notice_id)
            ->count();

        $scoreCount = $evaluation
            ->scores()
            ->whereIn('requirement_id', array_keys($inputs))
            ->where('score', '>', 0)
            ->whereNotNull('score')
            ->count();

        if ($scoreCount == $requirementCount) {
            $evaluation->status = 'completed';
        } else {
            $evaluation->status = 'incomplete';
        }

        $evaluation->score = $evaluation
            ->scores()
            ->whereIn('requirement_id', array_keys($inputs))
            ->whereNotNull('score')->sum('score');

        $evaluation->remarks = $request->input('remarks');
        $evaluation->save();

        return redirect()
            ->route('admin.evaluations.index')
            ->with('notice', trans('evaluations.notices.updated'));
    }
}
