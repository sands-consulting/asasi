<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\AuthLogsRepository;
use App\Http\Controllers\Controller;
use App\RequirementCommercial;
use App\Repositories\CommercialRequirementsRepository;

class CommercialRequirementsController extends Controller
{
    
    public function store(Request $request, RequirementCommercial $commercialRequirement)
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

        $commercialRequirement = CommercialRequirementsRepository::create(new RequirementCommercial, $inputs);

        return response()->json($commercialRequirement);
    }

    public function update(Request $request)
    {
        $id = $request->get('pk');
        $name = $request->get('name');
        $value = $request->get('value');

        $commercialRequirement = RequirementCommercial::find($id);
        $commercialRequirement->$name = is_array($value) ? $value[0]:$value;
        $commercialRequirement->save();

        return response()->json($commercialRequirement);
    }

    public function delete(RequirementCommercial $requirementCommercial)
    {
        CommercialRequirementsRepository::delete($requirementCommercial);
        return response()->json($requirementCommercial);
    }
}