<?php

namespace App\Services;

use App\Evaluation;

class EvaluationService extends BaseService
{
	public static function getEvaluations($userId)
	{
	    //todo group by notice in panel
        $evaluations = Evaluation::whereUserId($userId)
            ->leftJoin('notices', 'notices.id', '=', 'evaluations.notice_id')
            ->leftJoin('submissions', 'submissions.id', '=', 'evaluations.submission_id')
            ->leftJoin('evaluation_types', 'evaluation_types.id', '=', 'evaluations.type_id')
            ->select(
                'notices.number as notice_number',
                'notices.name as notice_name',
                'notices.description as notice_description',
                'evaluation_types.name as type',
                'submissions.number as submission_number',
                'evaluations.*'
            )
            ->get();

	    return $evaluations;
	}

}
