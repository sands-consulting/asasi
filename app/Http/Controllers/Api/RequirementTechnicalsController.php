<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\AuthLogsRepository;
use App\Http\Controllers\Controller;
use App\RequirementTechnical;
use App\Repositories\RequirementTechnicalsRepository;

class RequirementTechnicalsController extends Controller
{
    
    public function store(Request $request, RequirementTechnical $requirementTechnical)
    {
        $inputs = $request->only(
            'title',
            'mandatory',
            'require_file',
            'notice_id'
        );

        // Fixme: temp solution
        $inputs['mandatory'] = $inputs['mandatory'][0];
        $inputs['require_file'] = $inputs['require_file'][0];
        $requirementTechnical = RequirementTechnicalsRepository::create(new RequirementTechnical, $inputs);

        return response()->json($requirementTechnical);
    }

    public function update(Request $request)
    {
        $id = $request->get('pk');
        $name = $request->get('name');
        $value = $request->get('value');

        $requirementTechnical = RequirementTechnical::find($id);
        $requirementTechnical->$name = is_array($value) ? $value[0]:$value;
        $requirementTechnical->save();

        return response()->json($requirementTechnical);
    }

    public function delete(RequirementTechnical $requirementTechnical)
    {
        RequirementTechnicalsRepository::delete($requirementTechnical);
        return response()->json($requirementTechnical);
    }
}