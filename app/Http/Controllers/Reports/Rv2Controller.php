<?php

namespace App\Http\Controllers\Reports;

use App\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Rv2Controller extends Controller
{
    public function create()
    {
        return view('reports.rv2.index');
    }
}
