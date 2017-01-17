<?php

namespace App\Http\Controllers\Reports;

use App\Application;
use App\Setting;
use App\Http\Requests;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
	public function index()
	{
		return view('reports.index');
	}
}
