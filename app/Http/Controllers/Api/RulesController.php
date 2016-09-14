<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\AuthLogsRepository;
use App\Http\Controllers\Controller;
use App\Rule;
use App\Repositories\RulesRepository;

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
            $data = RulesRepository::create(new Rule, ['notice_id' => $noticeId]);

            foreach ($qcids as $qcid) {
                if ($rule['condition'] == 'or') {
                    $data = RulesRepository::create(new Rule, ['notice_id' => $noticeId]);
                }

                $data->qualificationCodes->attach($rule['field_code_id']);
            }

        }

        return response()->json($rule);
    }
}