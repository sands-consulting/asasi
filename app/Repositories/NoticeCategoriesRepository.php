<?php

namespace App\Repositories;

use App\NoticeCategory;
use Sands\Asasi\Foundation\Repository\Exceptions\RepositoryException;

class NoticeCategoriesRepository extends BaseRepository 
{
    public static function activate(NoticeCategory $noticeCategory)
    {
        if($noticeCategory->status == 'active')
        {
            throw new RepositoryException('Activating ' . NoticeCategory::class, $noticeCategory);
        }

        $noticeCategory->status = 'active';
        $noticeCategory->save();
    }

    public static function deactivate(NoticeCategory $noticeCategory)
    {
        if($noticeCategory->status == 'inactive')
        {
            throw new RepositoryException('Deactivating ' . NoticeCategory::class, $noticeCategory);
        }

        $noticeCategory->status = 'inactive';
        $noticeCategory->save();
    }
}
