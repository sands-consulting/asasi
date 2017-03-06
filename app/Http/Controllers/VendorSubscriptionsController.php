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

class VendorSubscriptionsController extends Controller
{
    public function index(Vendor $vendor)
    {
        return view('vendors.users.index');
    }

    public function show(Vendor $vendor, Subscription $subscription)
    {
        return view('vendors.users.show', compact('vendor'));
    }

    public function create(Vendor $vendor)
    {

    }
}
