<?php

namespace App\Http\Controllers\Admin;

use App\Subscription;
use App\DataTables\SubscriptionsDataTable;
use App\Http\Requests\SubscriptionRequest;
use App\Repositories\SubscriptionsRepository;
use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
    public function index(SubscriptionsDataTable $table)
    {
        return $table->render('admin.subscriptions.index');
    }

    public function create(Request $request)
    {
        return view('admin.subscriptions.create', ['subscription' => new Subscription]);
    }

    public function store(SubscriptionRequest $request)
    {
        $inputs  = $request->all();
        $exists = Subscription::where('vendor_id', $inputs['vendor_id'])->active()->first();

        if (!$exists) {
            $subscription = SubscriptionsRepository::create(new Subscription, $inputs);
        } else {
            return redirect()
                ->route('admin.subscriptions.create')
                ->withInput($inputs)
                ->with('alert', trans('subscriptions.notices.existed', ['name' => $exists->name]));
        }

        return redirect()
            ->route('admin.subscriptions.show', $subscription->id)
            ->with('notice', trans('subscriptions.notices.created', ['name' => $subscription->name]));
    }

    public function show(Subscription $subscription)
    {
        $vendor = $subscription->vendor;
        return view('admin.subscriptions.show', compact('subscription', 'vendor'));
    }

    public function edit(Subscription $subscription)
    {
        return view('admin.subscriptions.edit', compact('subscription'));
    }

    public function update(SubscriptionRequest $request, Subscription $subscription)
    {
        $inputs = $request->all();
        $subscription = SubscriptionsRepository::update($subscription, $inputs);

        return redirect()
            ->route('admin.subscriptions.edit', $subscription->id)
            ->with('notice', trans('subscriptions.notices.updated', ['name' => $subscription->name]));
    }

    public function duplicate(Subscription $subscription)
    {
        $subscription->name = $subscription->name . '-' . str_random(4);
        $subscription = SubscriptionsRepository::duplicate($subscription);
        return redirect()
            ->action('SubscriptionsController@edit', $subscription->getSlug())
            ->with('success', trans('subscriptions.created', ['name' => $subscription->name]));
    }

    public function destroy(Subscription $subscription)
    {
        SubscriptionsRepository::delete($subscription);
        return redirect()
            ->route('admin.subscriptions.index')
            ->with('notice', trans('subscriptions.notices.deleted', ['name' => $subscription->name]));
    }

    public function logs(Subscription $subscription, SubscriptionLogsDataTable $table)
    {
        $table->setActionable($subscription);
        return $table->render('admin.subscriptions.logs', compact('subscription'));
    }

    public function activate(Request $request, Subscription $subscription)
    {
        SubscriptionsRepository::activate($subscription);
        return redirect()
            ->to($request->input('redirect_to', route('admin.subscriptions.show', $subscription->id)))
            ->with('notice', trans('subscriptions.notices.activated', ['name' => $subscription->name]));
    }

    public function deactivate(Request $request, Subscription $subscription)
    {
        SubscriptionsRepository::deactivate($subscription);
        return redirect()
            ->to($request->input('redirect_to', route('admin.subscriptions.show', $subscription->id)))
            ->with('notice', trans('subscriptions.notices.deactivated', ['name' => $subscription->name]));
    }

    public function cancel(Request $request, Subscription $subscription)
    {
        SubscriptionsRepository::cancel($subscription);
        return redirect()
            ->to($request->input('redirect_to', route('admin.subscriptions.show', $subscription->id)))
            ->with('notice', trans('subscriptions.notices.cancelled', ['name' => $subscription->name]));
    }
}
