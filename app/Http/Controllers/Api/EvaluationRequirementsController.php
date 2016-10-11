<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\AuthLogsRepository;
use App\Http\Controllers\Controller;
use App\EvaluationRequirement;
use App\EvaluationType;
use App\Notice;
use App\Repositories\EvaluationRequirementsRepository;

class EvaluationRequirementsController extends Controller
{
    
    public function store(Request $request, Notice $notice)
    {
        $inputs = $request->only(
            'sequence',
            'title',
            'full_score',
            'type'
        );

        $inputs['notice_id'] = $notice->id;
        $inputs['evaluation_type_id'] = EvaluationType::whereName($inputs['type'])->first()->id;

        $requirement = EvaluationRequirementsRepository::create(new EvaluationRequirement, $inputs);

        return response()->json($requirement);
    }

    public function update(Request $request)
    {
        $id = $request->get('pk');
        $name = $request->get('name');
        $value = $request->get('value');

        $requirement = EvaluationRequirement::find($id);
        $requirement->$name = is_array($value) ? $value[0]:$value;
        $requirement->save();

        return response()->json($requirement);
    }

    public function delete(EvaluationRequirement $requirement)
    {
        EvaluationRequirementsRepository::delete($requirement);
        return response()->json($requirement);
    }
}