<?php

namespace App\Services;

use App\Notice;
use App\Submission;
use App\SubmissionRequirement;

class SubmissionService extends BaseService {

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

        return $requirementData->pluck('id') == $detailsData->pluck('requirement_id');
    }

    public static function labels(Notice $notice, $inputs)
    {
        foreach($inputs as $submissionId => $label)
        {
            $submission = $notice->submissions()->find($submissionId);

            if($submission)
            {
                $submission->label = $label;
                $submission->save();
            }
        }
    }

    public static function evaluators(Notice $notice, $inputs)
    {
        $active = [];

        foreach($inputs as $submissionId => $data)
        {
            $submission = $notice->submissions()->find($submissionId);

            if(!$submission)
            {
                continue;
            }

            foreach($data as $typeId => $userIds)
            {
                foreach($userIds as $userId)
                {
                    $evaluation = $notice->evaluations()->firstOrCreate([
                        'type_id' => $typeId,
                        'user_id' => $userId,
                        'submission_id' => $submissionId
                    ]);

                    if(!in_array($evaluation->status, ['pending', 'active']))
                    {
                        $evaluation->status = 'pending';
                    }

                    $evaluation->save();

                    $active[] = $evaluation->id;
                }
            }
        }

        $notice->evaluations()->whereNotIn('id', $active)->update(['status' => 'cancelled']);
    }
}
