<?php

namespace App\Repositories;

use App\Place;
use Sands\Asasi\Foundation\Repository\Exceptions\RepositoryException;

class PlacesRepository extends BaseRepository 
{
	public static function activate(Place $place)
    {
        if($place->status == 'active')
        {
            throw new RepositoryException('Activating ' . Place::class, $place);
        }

        $place->status = 'active';
        $place->save();
    }

    public static function deactivate(Place $place)
    {
        if($place->status == 'suspended')
        {
            throw new RepositoryException('Deactivating ' . Place::class, $place);
        }

        $place->status = 'inactive';
        $place->save();
    }

}
