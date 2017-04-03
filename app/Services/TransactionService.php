<?php

namespace App\Services;

use App\Transaction;
use Sands\Asasi\Service\Exceptions\ServiceException;

class TransactionService extends BaseService 
{
	public static function refund(Transaction $detail)
    {
        if($detail->status == 'refunded')
        {
            throw new ServiceException('Refunding ' . Transaction::class, $detail);
        }

        $detail->status = 'refunded';
        $detail->save();
    }
}
