<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\Notice;
use App\DataTables\DashboardAllDataTable;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request, DashboardAllDataTable $table)
    {
        $input = $request->only('type');
        return $table->forType($input['type'])->render('home.index');
    }

    public function submissions(Request $request)
    {
    }

    public function awards(Request $request)
    {
    }

    public function contact(Request $request)
    {
    }

    public function helps(Request $request)
    {
    }
}