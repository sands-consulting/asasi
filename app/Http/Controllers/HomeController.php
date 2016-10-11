<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Notice;
use App\DataTables\UsersDemoDataTable;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDemoDataTable $table)
    {
        
        return $table->render('home.index');
    }
}
