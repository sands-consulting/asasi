<?php

namespace App\Repositories;

use App\Notice;
use Sands\Asasi\Foundation\Repository\Exceptions\RepositoryException;

class NoticesRepository extends BaseRepository 
{
	public static function publish(Notice $notice)
    {
        if($notice->status == 'published')
        {
            throw new RepositoryException('Publishing ' . Notice::class, $notice);
        }

        $notice->status = 'published';
        $notice->save();
    }

    public static function unpublish(Notice $notice)
    {
        if($notice->status == 'not-publish')
        {
            throw new RepositoryException('Unpublishing ' . Notice::class, $notice);
        }

        $notice->status = 'not-publish';
        $notice->save();
    }

}
