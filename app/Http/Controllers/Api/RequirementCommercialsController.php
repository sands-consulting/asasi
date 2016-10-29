<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\AuthLogsRepository;
use App\Http\Controllers\Controller;
use App\Notice;
use App\SubmissionRequirement;
use App\Repositories\SubmissionRequirementsRepository;

class RequirementCommercialsController extends Controller
{
    
    public function store(Request $request, Notice $notice)
    {
        $inputs = $request->only(
            'title',
            'mandatory',
            'require_file'
        );

        // Fixme: temp solution
        $inputs['mandatory'] = $inputs['mandatory'][0] ?: 0;
        $inputs['require_file'] = $inputs['require_file'][0] ?: 0;
        $inputs['field_type'] = $inputs['require_file'] == 1 ? 'file' : 'check';
        $inputs['type'] = 'commercials';
        $inputs['notice_id'] = $notice->id;
        $submissionRequirement = SubmissionRequirementsRepository::create(new SubmissionRequirement, $inputs);

        return response()->json($submissionRequirement);
    }

    public function update(Request $request)
    {
        $id = $request->get('pk');
        $name = $request->get('name');
        $value = $request->get('value');

        $submissionRequirement = SubmissionRequirement::find($id);
        $submissionRequirement->$name = is_array($value) ? $value[0]:$value;
        $submissionRequirement->save();

        return response()->json($submissionRequirement);
    }

    public function delete(SubmissionRequirement $submissionRequirement)
    {
        SubmissionRequirementsRepository::delete($submissionRequirement);
        return response()->json($submissionRequirement);
    }
}