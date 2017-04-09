<?php

namespace App\Http\Controllers\Admin;

use App\PaymentGateway;
use App\DataTables\PaymentGatewaysDataTable;
use App\DataTables\UserHistoriesDataTable;
use App\Http\Requests\PaymentGatewayRequest;
use App\Services\PaymentGatewayService;
use Illuminate\Http\Request;
use JavaScript;

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
        $inputs  = $request->except('settings', 'organizations');
        $gateway = PaymentGatewayService::create(new PaymentGateway, $inputs);
        PaymentGatewayService::settings($gateway, $request->input('settings'));
        PaymentGatewayService::organizations($gateway, $request->input('organizations', []));

        return redirect()
            ->route('admin.payment-gateways.index')
            ->with('notice', trans('payment-gateways.notices.created', ['name' => $gateway->name]));
    }

    public function edit(PaymentGateway $gateway)
    {
        JavaScript::put([
            'settings' => $gateway->settings()->get()
        ]);
        return view('admin.payment-gateways.edit', compact('gateway'));
    }

    public function update(PaymentGatewayRequest $request, PaymentGateway $gateway)
    {
        $inputs  = $request->except('settings', 'organizations');
        $gateway = PaymentGatewayService::create($gateway, $inputs);
        PaymentGatewayService::settings($gateway, $request->input('settings'));
        PaymentGatewayService::organizations($gateway, $request->input('organizations', []));

        return redirect()
            ->route('admin.payment-gateways.index')
            ->with('notice', trans('payment-gateways.notices.updated', ['name' => $gateway->name]));
    }

    public function duplicate(PaymentGateway $gateway)
    {
        $gateway->name = $gateway->name . '-' . str_random(4);
        $gateway = PaymentGatewayService::duplicate($gateway);
        return redirect()
            ->route('admin.payment-gateways.index')
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
