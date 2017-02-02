<?php

namespace App\Services;

use App\News;
use Sands\Asasi\Service\Exceptions\ServiceException;

class NewsService extends BaseService 
{
	public static function publish(News $news)
    {
        if($news->status == 'published')
        {
            throw new ServiceException('Publishing ' . News::class, $news);
        }
        $news->update(['status' => 'published']);
    }

    public static function unpublish(News $news)
    {
        if($news->status == 'not-published')
        {
            throw new ServiceException('Unpublishing ' . News::class, $news);
        }
        $news->update(['status' => 'not-published']);
    }
}
