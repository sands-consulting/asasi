<?php

namespace App\Http\Controllers\Admin;


use App\DataTables\EvaluationsDataTable;
use App\DataTables\EvaluationSubmissionDataTable;
use App\EvaluationRequirement;
use App\EvaluationScore;
use App\Submission;
use App\Notice;
use App\Repositories\EvaluationScoresRepository;
use Illuminate\Http\Request;

class EvaluationsController extends Controller
{
    public function index(EvaluationsDataTable $table)
    {
        return $table->render('admin.evaluations.index');
    }

    public function submission(Request $request, EvaluationSubmissionDataTable $table, Notice $notice)
    {
        $inputs = $request->only('type');
        return $table->byNoticeId($notice->id)
            ->byUserId($request->user()->id)
            ->forType($inputs['type'])
            ->render('admin.evaluations.submissions', compact('notice'));
    }

    public function create(Notice $notice, Submission $submission)
    {
        $evaluationRequirements = EvaluationRequirement::where('evaluation_type_id', 1)->get();
        return view('admin.evaluations.create', compact('notice', 'evaluationRequirements', 'submission'));
    }

    public function store(Request $request, Notice $notice, Submission $submission)
    {
        $inputs = $request->only('scores');

        foreach ($inputs['scores'] as $evaluation_requirement_id => $score) {
            EvaluationScoresRepository::create(new EvaluationScore, [
                'score' => $score,
                'remark' => null,
                'evaluation_requirement_id' => $evaluation_requirement_id,
                'submission_id' => $submission->id,
                'user_id' => $request->user()->id
            ]);
        }

        $requirements = EvaluationRequirement::where('evaluation_type_id', 1)
            ->where('notice_id', $notice->id);

        if ($submission->scores->count() == $requirements->count()) {
            $submission->evaluators()->updateExistingPivot($request->user()->id,['status'=>'completed']);
        }

        return redirect()
            ->route('admin.evaluations.edit', [$notice->id, $submission->id])
            ->with('notice', trans('evaluations.notices.created'));
    }

    public function edit(Notice $notice, Submission $submission)
    {
        $requirements = EvaluationRequirement::where('evaluation_type_id', 1)
            ->where('notice_id', $notice->id)
            ->get();

        // Fixme: Find better solution to populate score
        $requirements = $requirements->each(function($requirement) {
            $requirement->score = $requirement->scores()
                ->where('user_id', \Auth::user()->id)
                ->first()->score;
        });

        return view('admin.evaluations.edit', compact('notice', 'requirements', 'submission'));
    }

    public function update(Request $request, Notice $notice, Submission $submission)
    {
        $inputs = $request->only('scores');
        foreach ($inputs['scores'] as $evaluation_requirement_id => $score) {
            $evaluationScore = EvaluationScore::whereEvaluationRequirementId($evaluation_requirement_id)->first();
            EvaluationScoresRepository::update($evaluationScore, [
                'score' => $score,
                'remark' => null,
                'user_id' => $request->user()->id
            ]);
        }

        $requirements = EvaluationRequirement::where('evaluation_type_id', 1)
            ->where('notice_id', $notice->id);

        if ($submission->scores->count() == $requirements->count()) {
            $submission->evaluators()->updateExistingPivot($request->user()->id,['status'=>'completed']);
        }

        return redirect()
            ->route('admin.evaluations.edit', [$notice->id, $submission->id])
            ->with('notice', trans('evaluations.notices.updated'));
    }
}
