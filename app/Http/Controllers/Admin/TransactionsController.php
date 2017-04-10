<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Subscription;
use App\DataTables\SubscriptionsDataTable;
use App\Http\Requests\SubscriptionRequest;
use App\Services\SubscriptionsService;
use App\Services\UserHistoriesService;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function index(SubscriptionsDataTable $table)
    {
        return $table->render('admin.transactions.index');
    }

    public function create(Request $request)
    {
        return view('admin.transactions.create', ['transaction' => new Subscription]);
    }

    public function store(SubscriptionRequest $request)
    {
        $inputs  = $request->only(['started_at', 'expired_at', 'vendor_id', 'package_id']);
        $exists = Subscription::where('vendor_id', $inputs['vendor_id'])->active()->first();

        if (!$exists) {
            $transaction = SubscriptionsService::create(new Subscription, $inputs);
        } else {
            return redirect()
                ->route('admin.transactions.create')
                ->withInput($inputs)
                ->with('alert', trans('transactions.notices.existed', ['name' => $exists->vendor->name]));
        }

        return redirect()
            ->route('admin.transactions.show', $transaction->id)
            ->with('notice', trans('transactions.notices.created', ['name' => $transaction->name]));
    }

    public function show(Subscription $transaction)
    {
        $vendor = $transaction->vendor;
        return view('admin.transactions.show', compact('transaction', 'vendor'));
    }

    public function edit(Subscription $transaction)
    {
        return view('admin.transactions.edit', compact('transaction'));
    }

    public function update(SubscriptionRequest $request, Subscription $transaction)
    {
        $inputs = $request->all();
        $transaction = SubscriptionsService::update($transaction, $inputs);

        return redirect()
            ->route('admin.transactions.edit', $transaction->id)
            ->with('notice', trans('transactions.notices.updated', ['name' => $transaction->name]));
    }

    public function duplicate(Subscription $transaction)
    {
        $transaction->name = $transaction->name . '-' . str_random(4);
        $transaction = SubscriptionsService::duplicate($transaction);
        return redirect()
            ->action('SubscriptionsController@edit', $transaction->getSlug())
            ->with('success', trans('transactions.created', ['name' => $transaction->name]));
    }

    public function destroy(Subscription $transaction)
    {
        SubscriptionsService::delete($transaction);
        return redirect()
            ->route('admin.transactions.index')
            ->with('notice', trans('transactions.notices.deleted', ['name' => $transaction->name]));
    }

    public function histories(Subscription $transaction, SubscriptionLogsDataTable $table)
    {
        $table->setActionable($transaction);
        return $table->render('admin.transactions.histories', compact('transaction'));
    }

    public function activate(Request $request, Subscription $transaction)
    {
        SubscriptionsService::activate($transaction);
        return redirect()
            ->to($request->input('redirect_to', route('admin.transactions.show', $transaction->id)))
            ->with('notice', trans('transactions.notices.activated', ['name' => $transaction->name]));
    }

    public function deactivate(Request $request, Subscription $transaction)
    {
        SubscriptionsService::deactivate($transaction);
        UserHistoriesService::log(Auth::user(), 'Deactivate', $transaction, $request->getClientIp(), $request->remarks);
        return redirect()
            ->to($request->input('redirect_to', route('admin.transactions.show', $transaction->id)))
            ->with('notice', trans('transactions.notices.deactivated', ['name' => $transaction->name]));
    }

    public function cancel(Request $request, Subscription $transaction)
    {
        SubscriptionsService::cancel($transaction);
        UserHistoriesService::log(Auth::user(), 'Cancel', $transaction, $request->getClientIp(), $request->remarks);
        return redirect()
            ->to($request->input('redirect_to', route('admin.transactions.show', $transaction->id)))
            ->with('notice', trans('transactions.notices.cancelled', ['name' => $transaction->name]));
    }
}
