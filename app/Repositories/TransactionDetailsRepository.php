<?php

namespace App\Repositories;

use App\TransactionDetail;
use Sands\Asasi\Foundation\Repository\Exceptions\RepositoryException;

class TransactionDetailsRepository extends BaseRepository 
{
	public static function refund(TransactionDetail $detail)
    {
        if($detail->status == 'refunded')
        {
            throw new RepositoryException('Publishing ' . TransactionDetail::class, $detail);
        }

        $detail->status = 'refunded';
        $detail->save();
    }
}
