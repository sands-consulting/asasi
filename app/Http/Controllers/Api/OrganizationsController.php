<?php

namespace App\Http\Controllers\Api;

use App\Organization;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrganizationsController extends Controller
{
    public function index(Request $request)
    {
        $organizations = Organization::orWhere('name', 'LIKE', "%{$request->input('q')}%")
                    ->orWhere('short_name', 'LIKE', "%{$request->input('q')}%")
                    ->get();

        return response()->json($organizations);
    }
}
