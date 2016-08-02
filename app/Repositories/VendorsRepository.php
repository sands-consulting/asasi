<?php

namespace App\Repositories;

use App\Vendor;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Sands\Asasi\Foundation\Repository\Exceptions\RepositoryException;

class VendorsRepository extends BaseRepository 
{
    public static function activate(Vendor $vendor)
    {
        if($vendor->status == 'active')
        {
            throw new RepositoryException('Activating ' . Vendor::class, $vendor);
        }

        $vendor->status = 'active';
        $vendor->save();
    }

    public static function deactivate(Vendor $vendor)
    {
        if($vendor->status == 'suspended')
        {
            throw new RepositoryException('Deactivating ' . Vendor::class, $vendor);
        }

        $vendor->status = 'inactive';
        $vendor->save();
    }
}
