<?php

namespace App\Repositories;

use App\Notice;
use App\Submission;
use App\SubmissionRequirement;

class SubmissionsRepository extends BaseRepository {

    public static function checkComplete(Notice $notice, Submission $submission, $type_id = null)
    {
        $requirementData = SubmissionRequirement::where('notice_id', $notice->id)
            ->orderBy('id');
        if (!is_null($type_id)) {
            $requirementData->where('type_id', $type_id);
        }

        $detailsData = $submission->details()
            ->orderBy('requirement_id');
        if (!is_null($type_id)) {
            $detailsData->where('type_id', $type_id);
            $detailsData->whereNotNull('value');
        }

        return $requirementData->lists('id') == $detailsData->lists('requirement_id');
    }
}
