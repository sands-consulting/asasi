<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\Notice;
use App\DataTables\HomeNoticesDataTable;
use App\DataTables\HomeSubmissionsDataTable;
use App\Repositories\DashboardRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request, HomeNoticesDataTable $table)
    {
        return $table->render('home.index', compact('numbers'));
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