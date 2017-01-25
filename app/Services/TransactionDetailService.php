<?php

namespace App\Services;

use App\TransactionDetail;
use Sands\Asasi\Service\Exceptions\ServiceException;

class TransactionDetailService extends BaseService 
{
	public static function refund(TransactionDetail $detail)
    {
        if($detail->status == 'refunded')
        {
            throw new ServiceException('Publishing ' . TransactionDetail::class, $detail);
        }

        $detail->status = 'refunded';
        $detail->save();
    }
}
