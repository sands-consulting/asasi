<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Subscription;
use App\DataTables\TransactionsDataTable;
use App\Http\Requests\SubscriptionRequest;
use App\Services\SubscriptionsService;
use App\Services\UserHistoriesService;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function index(TransactionsDataTable $table)
    {
        return $table->render('admin.transactions.index');
    }

    public function show(Subscription $transaction)
    {
        $vendor = $transaction->vendor;
        return view('admin.transactions.show', compact('transaction', 'vendor'));
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

    public function cancel(Request $request, Subscription $transaction)
    {
        SubscriptionsService::cancel($transaction);
        UserHistoriesService::log(Auth::user(), 'Cancel', $transaction, $request->getClientIp(), $request->remarks);
        return redirect()
            ->to($request->input('redirect_to', route('admin.transactions.show', $transaction->id)))
            ->with('notice', trans('transactions.notices.cancelled', ['name' => $transaction->name]));
    }
}
