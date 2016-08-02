<?php 

namespace App\Repositories;

use App\Package;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Sands\Asasi\Foundation\Repository\Exceptions\RepositoryException;

class PackagesRepository extends BaseRepository {
    public static function activate(Package $package)
    {
        if($package->status == 'active')
        {
            throw new RepositoryException('Activating ' . Package::class, $package);
        }

        $package->status = 'active';
        $package->save();
    }

    public static function deactivate(Package $package)
    {
        if($package->status == 'suspended')
        {
            throw new RepositoryException('Deactivating ' . Package::class, $package);
        }

        $package->status = 'inactive';
        $package->save();
    }
}