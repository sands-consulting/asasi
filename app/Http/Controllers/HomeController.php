<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Notice;
use App\DataTables\DashboardDataTable;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, DashboardDataTable $table)
    {
        $input = $request->only('type');
        return $table->forType($input['type'])->render('home.index');
    }
}
