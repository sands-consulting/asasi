<?php

namespace App\Http\Controllers\Admin;


use App\DataTables\EvaluationsDataTable;
use App\DataTables\EvaluationNoticesDataTable;
use App\DataTables\EvaluationSettingsDataTable;
use App\Submission;
use App\Notice;
use Illuminate\Http\Request;

class EvaluationRequirementsController extends Controller
{
    public function index(EvaluationNoticesDataTable $table, Notice $notice)
    {
        return $table->render('admin.notices.show.evaluation-requirements', compact('notice'));
    }

    public function edit(Notice $notice)
    {
        $requirementCommercials = $notice->evaluationRequirements()->commercials()->get();
        $requirementTechnicals = $notice->evaluationRequirements()->technicals()->get();

        return view('admin.notices.show.evaluation-requirements', compact('notice', 'requirementCommercials', 'requirementTechnicals'));
    }
}
