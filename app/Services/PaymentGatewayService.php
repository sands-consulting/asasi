<?php

namespace App\Services;

use App\PaymentGateway;
use Sands\Asasi\Service\Exceptions\ServiceException;

class PaymentGatewayService extends BaseService 
{
	public static function activate(PaymentGateway $gateway)
    {
        if($gateway->status == 'active')
        {
            throw new ServiceException('Activating ' . PaymentGateway::class, $gateway);
        }
        $news->update(['status' => 'published']);
    }

    public static function deactivate(PaymentGateway $gateway)
    {
        if($gateway->status == 'inactive')
        {
            throw new ServiceException('Deactivating ' . PaymentGateway::class, $gateway);
        }
        $news->update(['status' => 'inactive']);
    }
}
