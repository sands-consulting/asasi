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
        $evaluator = NoticeEvaluator::where('notice_id', $notice->id)
            ->where('user_id', $request->user()->id)
            ->first();

        return $table->byNoticeId($notice->id)
            ->byUserId($request->user()->id)
            ->forType($evaluator->type->id)
            ->render('admin.evaluations.submissions', compact('notice'));
    }

    public function create(Request $request, Notice $notice, Submission $submission)
    {
        $requirements = EvaluationRequirement::where('evaluation_type_id', $submission->type_id)
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

        $requirements = EvaluationRequirement::where('evaluation_type_id', 1)
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
        $requirements = EvaluationRequirement::where('evaluation_requirements.notice_id', $notice->id)
            ->leftJoin('evaluation_scores', 'evaluation_scores.evaluation_requirement_id', '=', 'evaluation_requirements.id')
            ->leftJoin('submissions', 'submissions.id', '=', 'evaluation_scores.submission_id')
            ->where('submissions.id', $submission->id)
            ->select([
                'evaluation_requirements.id as requirement_id',
                'evaluation_requirements.*', 
                'evaluation_scores.*', 
                'submissions.*'
            ])
            ->get();

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

    public function summary(Notice $notice)
    {
        // Fixme: try to create dynamic query for evaluation type other than commercial and technical.
        $vendors = Vendor::leftJoin('submissions as commercials', 'commercials.vendor_id', '=', 'vendors.id')
            ->leftJoin('submissions as technicals', 'technicals.vendor_id', '=', 'vendors.id')
            ->where('commercials.notice_id', $notice->id)
            ->where('technicals.notice_id', $notice->id)
            ->where('commercials.type_id', 1)
            ->where('technicals.type_id', 2)
            ->select([
                'vendors.id',
                'vendors.name',
                'technicals.total_score as technical_score',
                'commercials.total_score as commercial_score',
                'commercials.price as offered_price',
                \DB::raw("'None' as offered_duration")
            ])
            ->groupBy('vendors.id')
            ->get();

        return view('admin.evaluations.summary', compact('notice', 'vendors'));
    }
}
