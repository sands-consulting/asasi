<?php

namespace App\Services;

use App\SubmissionItem;
use App\Upload;
use Auth;

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

    public static function files(SubmissionItem $item, $file)
    {
        $exists = [];
        if (isset($file)) {
            $name = sprintf('%s.%s', md5($file->getClientOriginalName()), $file->extension());
            $token = md5(time());
            $file->storeAs($token, $name, 'uploads');

            $upload = Upload::create([
                'name'            => $file->getClientOriginalName(),
                'token'           => $token,
                'path'            => public_path(sprintf('%s/%s', $token, $name)),
                'url'             => url(sprintf('%s/%s/%s', 'uploads', $token, $name)),
                'size'            => $file->getSize(),
                'mime_type'       => $file->getMimeType(),
                'uploadable_type' => 'App\SubmissionItem',
                'uploadable_id'   => $item->id,
                'user_id'         => Auth::check() ? Auth::user()->id : null,
            ]);
        }
    }
}
