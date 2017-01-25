<?php

namespace App\Services;

use App\NoticeCategory;
use Sands\Asasi\Service\Exceptions\ServiceException;

class NoticeCategorieService extends BaseService 
{
    public static function activate(NoticeCategory $noticeCategory)
    {
        if($noticeCategory->status == 'active')
        {
            throw new ServiceException('Activating ' . NoticeCategory::class, $noticeCategory);
        }

        $noticeCategory->status = 'active';
        $noticeCategory->save();
    }

    public static function deactivate(NoticeCategory $noticeCategory)
    {
        if($noticeCategory->status == 'inactive')
        {
            throw new ServiceException('Deactivating ' . NoticeCategory::class, $noticeCategory);
        }

        $noticeCategory->status = 'inactive';
        $noticeCategory->save();
    }
}
