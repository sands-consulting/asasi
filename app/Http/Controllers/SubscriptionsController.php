<?php

namespace App\Http\Controllers;

use App\Subscription;
use App\DataTables\SubscriptionHitoriesDataTable;
use App\Http\Requests\SubscriptionRequest;
use App\Repositories\SubscriptionsRepository;
use Auth;
use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
    public function index()
    {
        $subscription = Auth::user()->subscriptions()->where('subscriptions.status','active')->first();
        return view('subscriptions.index', compact('subscription'));
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

    public function history(SubscriptionHitoriesDataTable $table)
    {
        return $table->render('subscriptions.history');
    }
}