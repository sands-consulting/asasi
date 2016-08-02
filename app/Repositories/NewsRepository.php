<?php

namespace App\Repositories;

use App\News;
use Sands\Asasi\Foundation\Repository\Exceptions\RepositoryException;

class NewsRepository extends BaseRepository 
{
	public static function publish(News $news)
    {
        if($news->status == 'published')
        {
            throw new RepositoryException('Publishing ' . News::class, $news);
        }
        $news->update(['status' => 'published']);
    }

    public static function unpublish(News $news)
    {
        if($news->status == 'not-published')
        {
            throw new RepositoryException('Unpublishing ' . News::class, $news);
        }
        $news->update(['status' => 'not-published']);
    }
}
