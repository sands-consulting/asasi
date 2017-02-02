<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\AuthLogsService;
use App\Http\Controllers\Controller;
use App\UserHistory;
use App\Services\SubmissionEvaluationsService;

class DashboardController extends Controller
{
    public function chartLoginActivity()
    {
        $activities = UserHistory::select([
                \DB::raw('DATE(created_at) as date'),
                \DB::raw('COUNT(id) as count')
            ])
            ->groupBy(\DB::raw('DATE(created_at)'))
            ->where('action', 'login')
            ->get();

        foreach ($activities as $activity) {
            $data['label'][] = $activity->date;
            $data['logins'][] = $activity->count;
        }

        return response()->json($data);
    }
}