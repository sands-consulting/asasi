<?php

namespace App\Http\Controllers;

use Auth;
use App\Package;
use App\Vendor;
use Illuminate\Http\Request;

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
        $packages = Package::whereStatus('active')->orderBy('fee_amount')->get();
        return view('vendors.subscriptions.create', compact('packages'));
    }
}
