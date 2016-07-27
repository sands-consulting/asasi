<?php

namespace App\Repositories;

use App\Organization;
use Sands\Asasi\Foundation\Repository\Exceptions\RepositoryException;

class OrganizationsRepository extends BaseRepository 
{
    public static function activate(Organization $organization)
    {
        if($organization->status == 'active')
        {
            throw new RepositoryException('Activating ' . Organization::class, $organization);
        }

        $organization->status = 'active';
        $organization->save();
    }

    public static function deactivate(Organization $organization)
    {
        if($organization->status == 'inactive')
        {
            throw new RepositoryException('Deactivating ' . Organization::class, $organization);
        }

        $organization->status = 'inactive';
        $organization->save();
    }

    public static function suspend(Organization $organization)
    {
        if($organization->status == 'suspended')
        {
            throw new RepositoryException('Suspending ' . Organization::class, $organization);
        }

        $organization->status = 'suspended';
        $organization->save();
    }
}
