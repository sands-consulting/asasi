<?php

namespace App\Services;

use App\Organization;
use Sands\Asasi\Exceptions\ServiceException;

class OrganizationService extends BaseService 
{
    public static function activate(Organization $organization)
    {
        if($organization->status == 'active')
        {
            throw new ServiceException('Activating ' . Organization::class, $organization);
        }

        $organization->status = 'active';
        $organization->save();
    }

    public static function deactivate(Organization $organization)
    {
        if($organization->status == 'inactive')
        {
            throw new ServiceException('Deactivating ' . Organization::class, $organization);
        }

        $organization->status = 'inactive';
        $organization->save();
    }

    public static function suspend(Organization $organization)
    {
        if($organization->status == 'suspended')
        {
            throw new ServiceException('Suspending ' . Organization::class, $organization);
        }

        $organization->status = 'suspended';
        $organization->save();
    }
}
