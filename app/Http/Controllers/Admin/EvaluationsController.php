<?php

namespace App\Http\Controllers\Admin;


use App\DataTables\EvaluationDataTable;
use App\DataTables\EvaluationSubmissionDataTable;
use App\Evaluation;
use App\EvaluationRequirement;
use App\EvaluationScore;
use App\Submission;
use App\Notice;
use App\NoticeEvaluator;
use App\User;
use App\Vendor;
use App\Services\EvaluationScoresService;
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

    public function view(Notice $notice, User $user, Submission $submission)
    {
        $requirements = EvaluationRequirement::where('evaluation_requirements.notice_id', $notice->id)
            ->leftJoin('evaluation_scores', 'evaluation_scores.evaluation_requirement_id', '=', 'evaluation_requirements.id')
            ->leftJoin('submissions', 'submissions.id', '=', 'evaluation_scores.submission_id')
            ->where('submissions.id', $submission->id)
            ->where('evaluation_scores.user_id', $user->id)
            ->select([
                'evaluation_requirements.*', 
                'evaluation_scores.score'
            ])
            ->get();

        return view('admin.evaluations.view', compact('notice', 'requirements', 'submission'));
    }

    public function edit(Request $request, Evaluation $evaluation, Submission $submission)
    {
        $score = $evaluation->scores()->where('user_id', $request->user()->id)->count();

        if (!$score) {
            $evaluator = $evaluation->user;

            $requirements = EvaluationRequirement::where('type_id', $evaluation->type_id)
                ->where('notice_id', $evaluation->notice->id)->get();
        } else {
            $requirements = EvaluationRequirement::where('evaluation_requirements.notice_id', $evaluation->notice->id)
                ->leftJoin('evaluation_scores', 'evaluation_scores.requirement_id', '=', 'evaluation_requirements.id')
                ->leftJoin('evaluations', 'evaluations.id', '=', 'evaluation_scores.evaluation_id')
                ->where('evaluations.id', $evaluation->id)
                ->select([
                    'evaluation_requirements.*', 
                    'evaluation_scores.score'
                ])
                ->get();
        }

        return view('admin.evaluations.edit', compact('requirements', 'evaluation', 'submission'));
    }

    public function update(Request $request, Evaluation $evaluation, Submission $submission)
    {
        $inputs = $request->only('scores');

        foreach ($inputs['scores'] as $requirement_id => $score) {
            $record = EvaluationScore::firstOrNew([
                'requirement_id' => $requirement_id,
                'evaluation_id'  => $evaluation->id,
                'user_id'        => $request->user()->id,
            ]);
        
            $record->score = $score != '' ? $score : null;
            $record->remarks = null;
            $record->save();
        }

        // Fixme: temp solution to get evaluator type
        $requirements = EvaluationRequirement::where('type_id', $evaluation->type_id)
            ->where('notice_id', $evaluation->notice->id);

        $scoreCount = $evaluation->scores()
            ->whereNotNull('score')
            ->count();

        if ($scoreCount == $requirements->count()) {
            $evaluation->status = 'completed';
        } else {
            $evaluation->status = 'incomplete';
        }

        $evaluation->save();

        return redirect()
            ->route('admin.evaluations.edit', [$evaluation->id, $submission->id])
            ->with('notice', trans('evaluations.notices.updated'));
    }
}
