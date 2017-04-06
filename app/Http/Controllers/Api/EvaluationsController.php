<?php

namespace App\Http\Controllers\Api;

use App\EvaluationType;
use App\Services\SubmissionDetailService;
use App\Submission;
use App\SubmissionDetail;
use Illuminate\Http\Request;
use App\Services\AuthLogsService;
use App\Http\Controllers\Controller;
use App\SubmissionEvaluation;
use App\Services\SubmissionEvaluationsService;

class EvaluationsController extends Controller
{
    
    public function store(Request $request, SubmissionEvaluation $evaluation)
    {
        $inputs = $request->only(
            'submission_evaluation'
        );

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
}