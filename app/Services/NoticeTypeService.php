<?php

namespace App\Services;

use App\NoticeType;
use Sands\Asasi\Service\Exceptions\ServiceException;

class NoticeTypeService extends BaseService 
{
    public static function activate(NoticeType $noticeType)
    {
        if($noticeType->status == 'active')
        {
            throw new ServiceException('Activating ' . NoticeType::class, $noticeType);
        }

        $noticeType->status = 'active';
        $noticeType->save();
    }

    public static function deactivate(NoticeType $noticeType)
    {
        if($noticeType->status == 'inactive')
        {
            throw new ServiceException('Deactivating ' . NoticeType::class, $noticeType);
        }

        $noticeType->status = 'inactive';
        $noticeType->save();
    }
}
