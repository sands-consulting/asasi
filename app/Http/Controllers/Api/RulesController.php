<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\AuthLogsService;
use App\Http\Controllers\Controller;
use App\Rule;
use App\Services\RulesService;

class RulesController extends Controller
{
    
    public function store(Request $request, Rule $rule)
    {
        $inputs = $request->only(
            'qualification_code_id',
            'condition',
            'rules'
        );

        // Fixme: temp solution
        $conditions = $inputs['condition'];
        $qcids = $inputs['qualification_code_id'];
        $noticeId = $inputs['id'];

        if (count($qcids) > 0) {
            $data = RulesService::create(new Rule, ['notice_id' => $noticeId]);

            foreach ($qcids as $qcid) {
                if ($rule['condition'] == 'or') {
                    $data = RulesService::create(new Rule, ['notice_id' => $noticeId]);
                }

                $data->qualificationCodes->attach($rule['field_code_id']);
            }

        }

        return response()->json($rule);
    }
}