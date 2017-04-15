<?php

namespace App\Http\Controllers\Reports;

use App\Application;
use App\Setting;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
	public function index()
	{
		return view('reports.index');
	}
}
