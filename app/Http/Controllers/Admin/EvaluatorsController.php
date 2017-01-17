<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\EvaluatorsDataTable;
use App\Events\EvaluatorAssigned;
use App\Events\EvaluatorSubmissionAssigned;
use App\Notice;
use App\NoticeEvaluator;
use App\Repositories\NoticeEvaluatorsRepository;
use App\User;
use Illuminate\Http\Request;

class EvaluatorsController extends Controller
{
    public function index(EvaluatorsDataTable $table, Notice $notice)
    {
        return $table->with('notice', $notice)->render('admin.notices.show.evaluators', compact('notice'));
    }

    public function edit(Notice $notice)
    {
        return view('admin.notices.show.evaluators-edit', compact('notice'));
    }

    public function save(Request $request, Notice $notice)
    {
        $input = $request->only('evaluators');
        $evaluators = [];

        if (isset($input['evaluators'])) {
            foreach ($input['evaluators'] as $typeId => $userIds) {
                foreach ($userIds as $userId) {
                    if (!$notice->evaluators()->where('user_id', $userId)->where('type_id', $typeId)->exists()) {
                        $notice->evaluators()->attach($userId, ['type_id' => $typeId, 'status' => 'pending']);
                        event(new EvaluatorAssigned($notice->id, $userId, $typeId));
                    }  else {
                        $notice->evaluators()->updateExistingPivot($userId, ['type_id' => $typeId]);
                    }
                }
            }
        }

        return redirect()
            ->route('admin.evaluators.index', [$notice->id])
            ->with('notice', 'Evaluator list updated.');
    }

    public function request(NoticeEvaluator $evaluator)
    {
        return view('admin.evaluators.request', compact('evaluator'));
    }

    public function assign(NoticeEvaluator $evaluator, Notice $notice)
    {
        return view('admin.notices.show.evaluators-assign', compact('evaluator', 'notice'));
    }

    public function assigned(Request $request, NoticeEvaluator $evaluator, Notice $notice)
    {
        $input = $request->only('submission_id');
        $submissionIds = $input['submission_id'];

        $submissionData = [];
        if (count($submissionIds) > 0) {
            foreach ($submissionIds as $submissionId) {
                if (!$evaluator->submissions()->where('submission_id', $submissionId)->exists()) {
                    $evaluator->submissions()->attach($submissionId, ['status' => 'incomplete']);
                }  else {
                    $evaluator->submissions()->updateExistingPivot($submissionId, ['status' => 'incomplete']);
                }
            }
            event(new EvaluatorSubmissionAssigned($evaluator));
        }

        return redirect()
            ->back()
            ->with('notices', trans('evaluators.notices.assigned'));
    }

    public function accept(NoticeEvaluator $evaluator)
    {
        NoticeEvaluatorsRepository::update($evaluator, ['status' => 'accepted']);

        return redirect()
            ->route('admin.evaluations.index')
            ->with('notices', trans('evaluators.notices.accepted', ['number' => $evaluator->notice->number]));
    }

    public function decline(NoticeEvaluator $evaluator)
    {
        NoticeEvaluatorsRepository::update($evaluator, ['status' => 'declined']);

        return redirect()
            ->route('admin.evaluations.index')
            ->with('notices', trans('evaluators.notices.declined', ['number' => $evaluator->notice->number]));
    }
}
