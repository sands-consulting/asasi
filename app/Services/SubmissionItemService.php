<?php

namespace App\Services;

class SubmissionItemService extends BaseService
{
    public static function statusCheck($submission, $requirements)
    {
        $submissionDetail = $submission->details()->pluck('requirement_id')->toArray();
        if (! empty(array_diff($requirements->pluck('id')->toArray(), $submissionDetail))) {
            return false;
        }
        return true;
    }
}
