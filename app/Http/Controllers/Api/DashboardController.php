<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\AuthLogsRepository;
use App\Http\Controllers\Controller;
use App\UserLog;
use App\Repositories\SubmissionEvaluationsRepository;

class DashboardController extends Controller
{
    public function chartLoginActivity()
    {
        $activities = UserLog::select([
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