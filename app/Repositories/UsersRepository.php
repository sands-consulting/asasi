<?php

namespace App\Repositories;

use App\User;
use Carbon\Carbon;
use Sands\Asasi\Foundation\Repository\Exceptions\RepositoryException;

class UsersRepository extends BaseRepository
{
    public static function assume(User $user)
    {
        app('session')->put('original_user_id', app('auth')->user()->id);
        app('auth')->login($user);
    }

    public static function resume()
    {
        $user = User::find(app('session')->pull('original_user_id'));
        if ($user)
        {
            app('auth')->login($user);
            return $user;
        }
    }

    public static function activate(User $user)
    {
        if($user->status == 'active')
        {
            throw new RepositoryException('Activating ' . User::class, $user);
        }

        $user->status = 'active';
        $user->save();
    }

    public static function suspend(User $user)
    {
        if($user->status == 'suspended')
        {
            throw new RepositoryException('Suspending ' . User::class, $user);
        }

        $user->status = 'suspended';
        $user->save();
    }

    public static function updatePassword(User $user, $password)
    {
        $user->update([
            'password' => brcypt($password)
        ]);
    }

    public static function deleteNonVerified($days)
    {
        $today = Carbon::today();

        return User::where('verified', 0)
            ->where('created_at', '<=', $today->subDays($days))
            ->forceDelete();
    }

    public static function restore(User $user)
    {
        $user->restore();
    }
}
