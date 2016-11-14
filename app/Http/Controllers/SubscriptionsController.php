<?php

namespace App\Http\Controllers;

use App\Package;
use App\Subscription;
use App\DataTables\SubscriptionHitoriesDataTable;
use App\Http\Requests\SubscriptionRequest;
use App\Repositories\SubscriptionsRepository;
use App\Repositories\VendorsRepository;
use Auth;
use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $packages = Package::whereStatus('active')->get();
        return view('subscriptions.index', compact('packages'));
    }

    public function create()
    {
        return view('subscriptions.create');
    }

    public function store(SubscriptionRequest $request)
    {
        $inputs = $request->all();
        $subscription = SubscriptionsRepository::create(new Subscription, $inputs, ['user_id' => Auth::user()->id]);
        
        return redirect()
            ->route('home.index')
            ->with('notice', trans('subscriptions.notices.public.saved', ['name' => $subscription->name]));
    }

    public function edit(Subscription $subscription)
    {
        return view('subscriptions.edit', ['subscription' => $subscription]);
    }

    public function update(SubscriptionRequest $request, Subscription $subscription)
    {
        $inputs = $request->all();
        $subscription = SubscriptionsRepository::update($subscription, $inputs);

        return redirect()
            ->route('subscriptions.edit', $subscription->id)
            ->with('notice', trans('subscriptions.notices.public.saved', ['name' => $subscription->name]));
    }

    public function payment(Request $request, Package $package)
    {
        return view('subscriptions.payment', compact('package'));
    }

    // temp to mock payment gateway
    public function endpoint(Request $request, Package $package)
    {
        $request->session()->put('package_id', $package->id);
        return redirect()
            ->route('subscriptions.redirect-uri')
            ->with('notice', trans('subscriptions.notices.public.paid'));
    }

    public function redirectUri(Request $request)
    {
        $package_id = $request->session()->get('package_id');
        $package    = Package::find($package_id);
        $vendor     = Auth::user()->vendor;

        VendorsRepository::subscribe($vendor, $package);

        $request->session()->forget('package_id');

        return redirect()
            ->route('subscriptions.current')
            ->with('notice', trans('subscriptions.notices.public.subscribed', ['name' => $package->name]));
    }

    public function current()
    {
        $subscription = Auth::user()->vendor->subscriptions()->active()->first();
        return view('subscriptions.current', compact('subscription'));
    }

    public function history(SubscriptionHitoriesDataTable $table)
    {
        return $table->render('subscriptions.history');
    }
}
