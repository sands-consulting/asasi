<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\Notice;
use App\DataTables\HomeNoticesDataTable;
use App\DataTables\HomeSubmissionsDataTable;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request, HomeNoticesDataTable $table)
    {
        return $table->render('home.index');
    }

    public function submissions(Request $request, HomeSubmissionsDataTable $table)
    {
        $vendor = $request->user()->vendor()->first();
        return $table->forVendor($vendor)->render('home.submissions');
    }

    public function awards(Request $request, HomeNoticesDataTable $table)
    {
        return $table->render('home.awards');
    }

    public function contact(Request $request)
    {
    }

    public function helps(Request $request)
    {
    }
}