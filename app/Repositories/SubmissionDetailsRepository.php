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
    public static function statusCheck(Notice $notice, Vendor $vendor)
    {
        $commercials = RequirementCommercial::where('notice_id', $notice->id)->lists('id')->toArray();
        $technicals = RequirementTechnical::where('notice_id', $notice->id)->lists('id')->toArray();
        $submissionCommercial = Submission::where('vendor_id', $vendor->id)->where('type', 'commercial')->first();
        $submissionTechnical = Submission::where('vendor_id', $vendor->id)->where('type', 'technical')->first();

        $detailTechnical = $submissionTechnical->details()->lists('requirement_id')->toArray();
        $detailCommercial = $submissionCommercial->details()->lists('requirement_id')->toArray();

        if (!empty(array_diff($commercials, $detailCommercial))) {
            return false;
        }

        if (!empty(array_diff($technicals, $detailTechnical))) {
            return false;
        }
        
        return true;
    }
}
