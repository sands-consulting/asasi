<?php

namespace App\Http\Controllers\Admin;

use App\Evaluation;
use App\DataTables\EvaluationsDataTable;
use App\Services\EvaluationScoresService;
use Illuminate\Http\Request;

class EvaluationsController extends Controller
{
    public function index(Request $request, EvaluationsDataTable $table)
    {
        $table->userId = $request->user()->id;
        return $table->render('admin.evaluations.index');
    }

    // Create Logic For evaluation acceptance
    public function accept(Request $request)
    {
        return redirect()->route('admin.evaluations.index')->with('notice', trans('evaluations.notices.accepted'));
    }

    public function show(Evaluation $evaluation)
    {
        return view('admin.evaluations.show', compact('evaluation'));
    }

    public function edit(Request $request, Evaluation $evaluation)
    {
        $requirements = $evaluation->requirements()->where('type_id', $evaluation->type->id)->whereStatus('active')->get();
        $scores = $evaluation->scores()->whereIn('requirement_id', $requirements->pluck('id'))->pluck('score', 'requirement_id');

        return view('admin.evaluations.edit', compact('evaluation', 'requirements', 'scores'));
    }

    public function update(Request $request, Evaluation $evaluation)
    {
        $inputs = $request->only('scores');

        foreach($inputs['score'] as $requirementId => $score)
        {
            $score = $evaluation->scores()->firstOrNew([
                'requirement_id' => $requirementId
            ]);
            $score->score = !empty($score) ? (int) $score : null;
            $score->save();
        }

        $requirements = $evaluation->requirements()->whereTypeId($evaluation->type_id)->whereNoticeId($evaluation->notice_id)->count();
        $scores = $evaluation->scores()->whereIn('requirement_id', array_keys($inputs))->where('score')->count();

        if ($scoreCount == $requirements->count())
        {
            $evaluation->status = 'completed';
        }
        else
        {
            $evaluation->status = 'incomplete';
        }

        $evaluation->score = $evaluation->scores()->whereIn('requirement_id', array_keys($inputs))->whereNotNull('score')->sum('score');
        $evaluation->save();

        return redirect()
            ->route('admin.evaluations.index')
            ->with('notice', trans('evaluations.notices.updated'));
    }
}
