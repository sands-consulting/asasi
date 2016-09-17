<?php

namespace App\Http\Controller\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

class RequirementCommercialsController extends Controller
{
    public function submission()
    {
        return view('requirement-commercials.submission', compact('requirements'))
    }
}
