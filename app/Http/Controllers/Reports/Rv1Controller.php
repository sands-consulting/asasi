<?php

namespace App\Http\Controllers\Reports;

use App\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Rv1Controller extends Controller
{
    public function create()
    {
        return view('reports.rv1.index');
    }
}
