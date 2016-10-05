<?php

namespace App\Http\Controllers\Admin;


use App\DataTables\EvaluationsDataTable;
use App\DataTables\EvaluationVendorsDataTable;
use App\Submission;
use App\Notice;
use Auth;
use Illuminate\Http\Request;

class EvaluationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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

    public function settings()
    {
        return view('admin.evaluations.settings');
    }
}
