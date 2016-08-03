<?php

namespace App\PaymentGateways;

class Ebpg
{
	public static $name 	= 'eBPG';

	public static $fields 	= [
		'merchant_account_number'	=> 'string',
		'transaction_endpoint_url'	=> 'string',
		'query_request_url'			=> 'string',
		'hash_key'					=> 'string'
	];
}