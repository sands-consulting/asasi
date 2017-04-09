<?php

namespace App\Http\Controllers;

use Auth;
use App\Package;
use App\PaymentGateway;
use App\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use JavaScript;

class SubscriptionsController extends Controller
{
    public function index()
    {
        return view('subscriptions.index');
    }

    public function show(Vendor $vendor, Subscription $subscription)
    {
        return view('subscriptions.show', compact('vendor'));
    }

    public function create()
    {
        $vendor = Auth::user()->vendor;

        if($vendor->subscriptions()->active()->count() > 0)
        {
            $subscription   = $vendor->subscriptions()->active()->orderBy('created_at', 'desc')->first();
            $startDate      = $subscription->start_at->format('Y-m-d');
        }
        else
        {
            $startDate  = Carbon::now()->format('Y-m-d');
        }

        JavaScript::put([
            'startDate' => $startDate,
            'packages' => Package::with('taxCode')->whereStatus('active')->orderBy('fee')->get(),
            'gateways' => PaymentGateway::whereStatus('active')->whereDefault(1)->orderBy('label')->get()
        ]);

        return view('subscriptions.create', compact('package'));
    }
}
