<?php

namespace App\Http\Controllers\Api;

use App\Notice;
use App\Submission;
use App\Http\Controllers\Controller;
use App\Vendor;
use Illuminate\Http\Request;

class VendorSubmissionsController extends Controller
{
    public function getNotice(Submission $submission)
    {
        $notice = $submission->notice;
        $notice->load([
            'evaluations',
            'evaluations.type',
        ]);

        $notice->evaluations->map(function ($evaluation) use ($submission) {
            $detail = $submission->details($evaluation->type_id)->first();
            $evaluation['submission_status'] = $detail ? $detail->status : 'incomplete';
            $evaluation['submission_exists'] = $detail ? true : false;
            $evaluation['submission_details'] = $detail;

            return $evaluation;
        });

        return response()->json($notice);
    }

    public function get()
    {
        return;
    }

    /**
     * @param Submission $submission
     * @return \Illuminate\Http\JsonResponse
     */
    // public function getSubmission(Submission $submission)
    // {
    //     $submission->load([
    //         'notice',
    //         'notice.evaluations',
    //         'details',
    //         'details.type',
    //     ]);
    //
    //     $submission->details->map(function ($detail) {
    //         $detail['method'] = $detail->has('items') ? 'edit' : 'create';
    //         return $detail;
    //     });
    //
    //     return response()->json($submission);
    // }


}