<?php

namespace App\Http\Controllers\Payments;

use App\PaymentGateway;
use App\Transaction;
use App\Http\Controllers\Controller;
use Billplz\Client;
use Http\Adapter\Guzzle6\Client as GuzzleHttpClient;
use Http\Client\Common\HttpMethodsClient;
use Http\Message\MessageFactory\GuzzleMessageFactory;
use Illuminate\Http\Request;
use Money\Money;

class BillplzController extends Controller
{
	public function connect(Request $request)
	{
		$transaction 	= Transaction::pending()->find($request->session()->get('transaction'));

		if(empty($transaction))
		{
			return redirect()->back()->with('alert', trans('transactions.notices.e1'));
		}

		$gateway		= PaymentGateway::whereStatus('active')->whereType('billplz')->find($request->session()->get('gateway'));

		if(empty($gateway))
		{
			return redirect()->back()->with('alert', trans('transactions.notices.e2'));
		}

		$billplz 	= $this->billplz($gateway);
		$bill 		= $billplz->bill(3);
		$response 	= $bill->create(
			setting('collection_id', null, $gateway),
			$transaction->user->email,
			null,
			$transaction->user->name,
			Money::MYR($transaction->total),
			route('payments.billplz.response'),
			trans('transactions.description', ['name' => setting('app-name')]),
			[
				'redirect_url' => route('payments.billplz.response'),
				'reference_1_label' => trans('transactions.attributes.transaction_number'),
				'reference_1' => $transaction->transaction_number
			]
		);

        $data = json_decode($response->getBody());
        $transaction->gateway()->associate($gateway);

        if (isset($data->id)) {
        	$transaction->gateway_request_message	= json_encode($data);
        	$transaction->gateway_reference_one 	= $data->id;
        	$transaction->save();

            return redirect($data->url);
        } else {
        	$transaction->gateway_request_message	= json_encode($data);
        	return redirect()->back()->with('alert', trans('transactions.notices.e3'));
        }
	}

	protected function billplz(PaymentGateway $gateway)
	{
        $http = new HttpMethodsClient(
            new GuzzleHttpClient(),
            new GuzzleMessageFactory()
        );

        $billplz = new Client($http, setting('api_key', null, $gateway));
        if (!!setting('sandbox', false, $gateway)) {
            $billplz->useSandbox();
        }

        return $billplz;
	}
}
