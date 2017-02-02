<?php

namespace App\Services;

class SubmissionDetailService extends BaseService
{
    public static function statusCheck($submission, $requirements)
    {
        $submissionDetail = $submission->details()->lists('requirement_id')->toArray();
        if (!empty(array_diff($requirements->lists('id')->toArray(), $submissionDetail))) {
            return false;
        }
        return true;
    }
}
