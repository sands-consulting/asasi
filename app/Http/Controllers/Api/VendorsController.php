<?php

namespace App\Http\Controllers\Api;

use App\Vendor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorsController extends Controller
{
    public function index(Request $request)
    {
        $vendors = Vendor::orWhere('name', 'LIKE', "%{$request->input('q')}%")
                    ->orWhere('registration_number', 'LIKE', "%{$request->input('q')}%")
                    ->get();

        return response()->json($vendors);
    }
}