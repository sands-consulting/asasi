<?php

namespace App\Services;

use App\User;
use Carbon\Carbon;
use Sands\Asasi\Service as BaseService;
use Sands\Asasi\Service\Exceptions\ServiceException;

class UserService extends BaseService
{
    public static function activate(User $user)
    {
        if($user->status == 'active')
        {
            throw new ServiceException('Activating ' . User::class, $user);
        }

        $user->status = 'active';
        $user->save();
    }

    public static function suspend(User $user)
    {
        if($user->status == 'suspended')
        {
            throw new ServiceException('Suspending ' . User::class, $user);
        }

        $user->status = 'suspended';
        $user->save();
    }

    public static function assume(User $user)
    {
        app('session')->put('resume_user_id', app('auth')->user()->id);
        app('auth')->login($user);
    }

    public static function resume()
    {
        $user = User::find(app('session')->pull('resume_user_id'));
        if($user)
        {
            app('auth')->login($user);
            return $user;
        }
    }
}
