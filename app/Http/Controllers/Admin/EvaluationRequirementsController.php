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
    public function index(EvaluationNoticesDataTable $table)
    {
        return $table->render('admin.evaluation-requirements.index');
    }

    public function create(Notice $notice)
    {
        return view('admin.evaluation-requirements.create', compact('notice'));
    }

    public function store(Notice $notice)
    {
        //
    }

    public function edit(Notice $notice)
    {
        $requirementCommercials = $notice->evaluationRequirements()->commercials()->get();
        $requirementTechnicals = $notice->evaluationRequirements()->technicals()->get();

        return view('admin.evaluation-requirements.edit', compact('notice', 'requirementCommercials', 'requirementTechnicals'));
    }

    public function update(Notice $notice)
    {
        //
    }
}
