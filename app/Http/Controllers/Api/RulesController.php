<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\AuthLogsRepository;
use App\Http\Controllers\Controller;
use App\Rule;
use App\Repositories\RulesRepository;

class RulesController extends Controller
{
    
    public function save(Request $request, Rule $rule)
    {
        $inputs = $request->only(
            'id',
            'rules',
        );

        // Fixme: temp solution
        $rules = $inputs['rule'];
        $noticeId = $inputs['id'];

        if (count($rules) > 0) {
            $data = RulesRepository::create(new Rule, ['notice_id' => $noticeId]);

            foreach ($rules as $rule) {
                if ($rule['condition'] == 'or') {
                    $data = RulesRepository::create(new Rule, ['notice_id' => $noticeId]);
                }
                
                $data->qualificationCodes->attach($rule['field_code_id']);
            }

        }

        if (isset($input['id'])) {
            $record = Rule::find($input['id']);
            $rule = RulesRepository::update($record, $input);
        } else {
            $rule = RulesRepository::create(new Rule, $input);
        }

        return response()->json($rule);
    }
}