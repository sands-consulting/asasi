<?php

namespace App\Http\Controllers;

use App\DataTables\VendorSubscriptionsDataTable;
use App\Events\VendorApplied;
use App\Events\VendorCancelled;
use App\Http\Requests\VendorRequest;
use App\Notificators\VendorAppliedNotificator;
use App\Services\VendorsService;
use App\Vendor;
use Auth;
use Illuminate\Http\Request;
use Route;

class VendorsSubscriptionsController extends Controller
{
    public function index(Vendor $vendor, Request $request)
    {
        return view('vendors.users.index');
    }

    public function show(Vendor $vendor, User $user)
    {
        return view('vendors.users.show', compact('vendor'));
    }
}
