<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Notice;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('home.index');
    }
}
