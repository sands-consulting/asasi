<?php

namespace App\Http\Controllers\Admin;


use App\DataTables\EvaluationsDataTable;
use App\DataTables\EvaluationVendorsDataTable;
use App\Submission;
use App\Notice;
use Illuminate\Http\Request;

class EvaluationsController extends Controller
{
    public function index(EvaluationsDataTable $table)
    {
        return $table->render('admin.evaluations.index');
    }

    public function vendors(EvaluationVendorsDataTable $table, $type)
    {
        return $table->forType($type)->render('admin.evaluations.vendors');
    }

    public function evaluate(Submission $submission)
    {
        $submissionDetails = $submission->details;
        return view('admin.evaluations.evaluate', compact('submission', 'submissionDetails'));
    }
}
