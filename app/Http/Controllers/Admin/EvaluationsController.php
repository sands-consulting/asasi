<?php

namespace App\Http\Controllers\Admin;


use App\DataTables\EvaluationDataTable;
use App\DataTables\EvaluationSubmissionDataTable;
use App\EvaluationRequirement;
use App\EvaluationScore;
use App\Submission;
use App\Notice;
use App\NoticeEvaluator;
use App\Vendor;
use App\Repositories\EvaluationScoresRepository;
use Illuminate\Http\Request;

class EvaluationsController extends Controller
{
    public function index(EvaluationDataTable $table)
    {
        return $table->render('admin.evaluations.index');
    }

    public function submission(Request $request, EvaluationSubmissionDataTable $table, Notice $notice)
    {
        return $table->byNoticeId($notice->id)
            ->byUserId($request->user()->id)
            ->render('admin.evaluations.submissions', compact('notice'));
    }

    public function create(Request $request, Notice $notice, Submission $submission)
    {
        $evaluator = NoticeEvaluator::where('notice_id', $notice->id)
            ->where('user_id', $request->user()->id)
            ->first();

        $requirements = EvaluationRequirement::where('evaluation_type_id', $evaluator->type_id)
            ->where('notice_id', $notice->id)->get();

        return view('admin.evaluations.create', compact('notice', 'requirements', 'submission'));
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

        // Fixme: temp solution to get evaluator type
        $evaluator = NoticeEvaluator::where('notice_id', $notice->id)
            ->where('user_id', $request->user()->id)
            ->first();

        $requirements = EvaluationRequirement::where('evaluation_type_id', $evaluator->type_id)
            ->where('notice_id', $notice->id);

        if ($submission->scores->count() == $requirements->count()) {
            $submission->evaluators()->updateExistingPivot($request->user()->id,['status'=>'completed']);
        }

        return redirect()
            ->route('admin.evaluations.edit', [$notice->id, $submission->id])
            ->with('notice', trans('evaluations.notices.created'));
    }

    public function edit(Request $request, Notice $notice, Submission $submission)
    {
        $score = $submission->scores()->where('user_id', $request->user()->id)->count();

        if (!$score) {
            $evaluator = NoticeEvaluator::where('notice_id', $notice->id)
                ->where('user_id', $request->user()->id)
                ->first();

            $requirements = EvaluationRequirement::where('evaluation_type_id', $evaluator->type_id)
                ->where('notice_id', $notice->id)->get();
        } else {
            $requirements = EvaluationRequirement::where('evaluation_requirements.notice_id', $notice->id)
                ->leftJoin('evaluation_scores', 'evaluation_scores.evaluation_requirement_id', '=', 'evaluation_requirements.id')
                ->leftJoin('submissions', 'submissions.id', '=', 'evaluation_scores.submission_id')
                ->where('submissions.id', $submission->id)
                ->where('evaluation_scores.user_id', $request->user()->id)
                ->select([
                    'evaluation_requirements.*', 
                    'evaluation_scores.score'
                ])
                ->get();
        }

        return view('admin.evaluations.edit', compact('notice', 'requirements', 'submission'));
    }

    public function update(Request $request, Notice $notice, Submission $submission)
    {
        $inputs = $request->only('scores');

        foreach ($inputs['scores'] as $evaluation_requirement_id => $score) {
            $record = EvaluationScore::firstOrNew([
                'evaluation_requirement_id' => $evaluation_requirement_id,
                'submission_id' => $submission->id,
                'user_id' => $request->user()->id
            ]);
        
            $record->score = $score != '' ? $score : null;
            $record->remark = null;
            $record->save();
        }

        // Fixme: temp solution to get evaluator type
        $evaluator = NoticeEvaluator::where('notice_id', $notice->id)
            ->where('user_id', $request->user()->id)
            ->first();

        $requirements = EvaluationRequirement::where('evaluation_type_id', $evaluator->type_id)
            ->where('notice_id', $notice->id);

        $scoreCount = $submission->scores()
            ->whereNotNull('score')
            ->where('user_id', $request->user()->id)
            ->count();

        if ($scoreCount == $requirements->count()) {
            $submission->evaluators()->updateExistingPivot($evaluator->id,['status'=>'completed']);
        } else {
            $submission->evaluators()->updateExistingPivot($evaluator->id,['status'=>'incomplete']);
        }

        return redirect()
            ->route('admin.evaluations.submission', [$notice->id])
            ->with('notice', trans('evaluations.notices.updated'));
    }
}
