<?php

namespace App\Services;

use App\Evaluation;

class EvaluationService extends BaseService
{
	public static function getEvaluations($userId)
	{
	    //todo group by notice in panel
        $evaluations = Evaluation::whereUserId($userId)
            ->where('evaluations.status', '!=', 'rejected')
            ->leftJoin('notices', 'notices.id', '=', 'evaluations.notice_id')
            ->leftJoin('submissions', 'submissions.id', '=', 'evaluations.submission_id')
            ->leftJoin('evaluation_types', 'evaluation_types.id', '=', 'evaluations.type_id')
            ->select('notices.number as notice', 'evaluation_types.name as type', 'submissions.number as submission_number', 'evaluations.*')
            ->get();

	    return $evaluations;
	}

}
