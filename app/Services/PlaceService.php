<?php

namespace App\Services;

use App\Place;
use Sands\Asasi\Service\Exceptions\ServiceException;

class PlaceService extends BaseService 
{
	public static function activate(Place $place)
    {
        if($place->status == 'active')
        {
            throw new ServiceException('Activating ' . Place::class, $place);
        }

        $place->status = 'active';
        $place->save();
    }

    public static function deactivate(Place $place)
    {
        if($place->status == 'suspended')
        {
            throw new ServiceException('Deactivating ' . Place::class, $place);
        }

        $place->status = 'inactive';
        $place->save();
    }

}
