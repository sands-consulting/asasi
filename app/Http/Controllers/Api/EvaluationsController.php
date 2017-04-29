<?php

namespace App\Http\Controllers\Api;

use App\Evaluation;
use App\EvaluationType;
use App\Submission;
use App\SubmissionDetail;
use App\SubmissionEvaluation;
use App\Services\AuthLogsService;
use App\Services\EvaluationService;
use App\Services\SubmissionDetailService;
use App\Services\SubmissionEvaluationsService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        return response()->json($evaluations);
    }

    public function store(Request $request, SubmissionEvaluation $evaluation)
    {
        $inputs = $request->only('submission_evaluation');

        $response = [];
        foreach ($inputs['submission_evaluation'] as $key => $value) {
            $value['submission_detail_id'] = $key;
            $evaluation = SubmissionEvaluationsService::create(new SubmissionEvaluation, $value);
            $response['data'][] = $evaluation;
        }

        return response()->json($response);
    }

    public function update(Request $request)
    {
        $id = $request->get('pk');
        $name = $request->get('name');
        $value = $request->get('value');

        $evaluation = SubmissionEvaluation::find($id);
        $evaluation->$name = is_array($value) ? $value[0]:$value;
        $evaluation->save();

        return response()->json($evaluation);
    }

    public function delete(SubmissionEvaluation $evaluation)
    {
        SubmissionEvaluationsService::delete($evaluation);
        return response()->json($evaluation);
    }

    public function accept(Request $request) 
    {
        $user = $request->user();
        $evaluation = Evaluation::find($request->get('id'));
        $evaluation = EvaluationService::update($evaluation, ['status' => 'accepted']);

        return response()->json($evaluation);
    }

    public function reject(Request $request)
    {
        $user = $request->user();
        $evaluation = Evaluation::find($request->get('id'));
        $evaluation = EvaluationService::update($evaluation, ['status' => 'rejected']);

        return response()->json($evaluation);
    }
}