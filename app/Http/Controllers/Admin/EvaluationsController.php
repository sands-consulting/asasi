<?php

namespace App\Http\Controllers\Admin;

use App\Evaluation;
use App\DataTables\EvaluationsDataTable;
use App\Services\EvaluationScoresService;
use App\Services\EvaluationService;
use Illuminate\Http\Request;
use JavaScript;

class EvaluationsController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->hasPermission('evaluation:list')) {
            $evaluations = EvaluationService::getEvaluations($user->id);
        } else {
            $evaluations = EvaluationService::getEvaluations($user->id);
        }

        JavaScript::put([
            'evaluations' => $evaluations
        ]);

        return view('admin.evaluations.index');
    }

    // Create Logic For evaluation acceptance
    public function accept(Request $request)
    {
        return redirect()
            ->route('admin.evaluations.index')
            ->with('notice', trans('evaluations.notices.accepted'));
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
        $inputs = $request->only('evaluations');

        foreach($inputs as $requirementId => $data) {
            $score = $evaluation->scores()->firstOrNew([
                'requirement_id' => $requirementId
            ]);
            $score->score = !empty($data['score']) ? (int) $data['score'] : null;
            $score->remarks = !empty($data['remarks']) ? (int) $data['remarks'] : null;
            $score->save();
        }

        $requirements = $evaluation
            ->requirements()
            ->whereTypeId($evaluation->type_id)
            ->whereNoticeId($evaluation->notice_id)
            ->count();

        $scores = $evaluation
            ->scores()
            ->whereIn('requirement_id', array_keys($inputs))
            ->where('score')
            ->count();

        if ($scoreCount == $requirements->count()) {
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
