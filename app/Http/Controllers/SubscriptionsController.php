<?php

namespace App\Http\Controllers;

use Auth;
use App\Package;
use App\Vendor;
use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
    public function index(Vendor $vendor)
    {
        return view('subscriptions.index');
    }

    public function show(Vendor $vendor, Subscription $subscription)
    {
        return view('subscriptions.show', compact('vendor'));
    }

    public function create(Vendor $vendor)
    {
        $packages = Package::whereStatus('active')->orderBy('fee_amount')->get();
        return view('subscriptions.create', compact('packages'));
    }
}
