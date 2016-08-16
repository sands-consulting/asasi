<?php

namespace App\Repositories;

use App\Place;
use Sands\Asasi\Foundation\Repository\Exceptions\RepositoryException;

class NoticesRepository extends BaseRepository 
{
	public static function publish(Place $place)
    {
        if($place->status == 'published')
        {
            throw new RepositoryException('Publishing ' . Place::class, $place);
        }

        $place->status = 'published';
        $place->save();
    }

    public static function unpublish(Place $place)
    {
        if($place->status == 'not-publish')
        {
            throw new RepositoryException('Unpublishing ' . Place::class, $place);
        }

        $place->status = 'not-publish';
        $place->save();
    }

}
