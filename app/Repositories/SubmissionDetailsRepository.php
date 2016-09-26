<?php

namespace App\Repositories;

use App\RequirementCommercial;
use App\RequirementTechnical;
use App\Submission;
use App\SubmissionDetail;
use App\Notice;
use App\Vendor;

class SubmissionDetailsRepository extends BaseRepository
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
