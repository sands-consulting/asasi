<?php

namespace App\Http\Controllers\Admin;

use App\PaymentGateway;
use App\DataTables\PaymentGatewaysDataTable;
use App\DataTables\UserHistoriesDataTable;
use App\Http\Requests\PaymentGatewayRequest;
use App\Services\PaymentGatewayService;
use Illuminate\Http\Request;

class PaymentGatewaysController extends Controller
{
    public function index(PaymentGatewaysDataTable $table)
    {
        return $table->render('admin.payment-gateways.index');
    }

    public function create(Request $request)
    {
        return view('admin.payment-gateways.create', ['gateway' => new PaymentGateway]);
    }

    public function store(PaymentGatewayRequest $request)
    {
        $inputs  = $request->input()->except('settings');
        $gateway = PaymentGatewayService::create(new PaymentGateway, $inputs);
        PaymentGateway::setting($gateway, $request->input()->only('settings'));

        return redirect()
            ->route('admin.payment-gateways.edit', $gateway->id)
            ->with('notice', trans('payment-gateways.notices.created', ['name' => $gateway->name]));
    }

    public function edit(PaymentGateway $gateway)
    {
        return view('admin.payment-gateways.edit', compact('gateway'));
    }

    public function update(PaymentGatewayRequest $request, PaymentGateway $gateway)
    {
        $inputs  = $request->input()->except('settings');
        $gateway = PaymentGatewayService::create($gateway, $inputs);
        PaymentGateway::setting($gateway, $request->input()->only('settings'));

        return redirect()
            ->route('admin.payment-gateways.edit', $gateway->id)
            ->with('notice', trans('payment-gateways.notices.updated', ['name' => $gateway->name]));
    }

    public function duplicate(PaymentGateway $gateway)
    {
        $gateway->name = $gateway->name . '-' . str_random(4);
        $gateway = PaymentGatewayService::duplicate($gateway);
        return redirect()
            ->action('PaymentGatewaysController@edit', $gateway->getSlug())
            ->with('success', trans('payment-gateways.created', ['name' => $gateway->name]));
    }

    public function destroy(PaymentGateway $gateway)
    {
        PaymentGatewayService::delete($gateway);
        return redirect()
            ->route('admin.payment-gateways.index')
            ->with('notice', trans('payment-gateways.notices.deleted', ['name' => $gateway->name]));
    }

    public function histories(PaymentGateway $gateway, UserHistoriesDataTable $table)
    {
        $table->setActionable($gateway);
        return $table->render('admin.payment-gateways.histories', compact('gateway'));
    }
}
