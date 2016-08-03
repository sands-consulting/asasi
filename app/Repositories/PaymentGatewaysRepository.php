<?php

namespace App\Repositories;

use App\PaymentGateway;
use Sands\Asasi\Foundation\Repository\Exceptions\RepositoryException;

class PaymentGatewaysRepository extends BaseRepository 
{
	public static function activate(PaymentGateway $gateway)
    {
        if($gateway->status == 'active')
        {
            throw new RepositoryException('Activating ' . PaymentGateway::class, $gateway);
        }
        $news->update(['status' => 'published']);
    }

    public static function deactivate(PaymentGateway $gateway)
    {
        if($gateway->status == 'inactive')
        {
            throw new RepositoryException('Deactivating ' . PaymentGateway::class, $gateway);
        }
        $news->update(['status' => 'inactive']);
    }
}
