<?php 

namespace App\Services;

use App\Package;
use App\User;
use Sands\Asasi\Service\Exceptions\ServiceException;

class PackageService extends BaseService
{
    public static function activate(Package $package)
    {
        if($package->status == 'active')
        {
            throw new ServiceException('Activating ' . Package::class, $package);
        }

        $package->status = 'active';
        $package->save();
    }

    public static function deactivate(Package $package)
    {
        if($package->status == 'suspended')
        {
            throw new ServiceException('Deactivating ' . Package::class, $package);
        }

        $package->status = 'inactive';
        $package->save();
    }
}
