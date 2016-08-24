<?php

namespace App\Repositories;

use App\NoticeType;
use Sands\Asasi\Foundation\Repository\Exceptions\RepositoryException;

class NoticeTypesRepository extends BaseRepository 
{
    public static function activate(NoticeType $noticeType)
    {
        if($noticeType->status == 'active')
        {
            throw new RepositoryException('Activating ' . NoticeType::class, $noticeType);
        }

        $noticeType->status = 'active';
        $noticeType->save();
    }

    public static function deactivate(NoticeType $noticeType)
    {
        if($noticeType->status == 'inactive')
        {
            throw new RepositoryException('Deactivating ' . NoticeType::class, $noticeType);
        }

        $noticeType->status = 'inactive';
        $noticeType->save();
    }
}
