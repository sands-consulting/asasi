<?php 

namespace App\Services;

use App\Bookmark;
use App\Notice;
use App\Project;
use App\User;

class DashboardService
{
    public static function notices(User $user)
    {
        return Notice::published()->count();
    }

    public static function eligibles(User $user)
    {
        return Notice::published()->whereHas('eligibles', function($query) use($user) {
            $query->where('vendor_id', $user->vendor->id);
        })->count();
    }

    public static function invitations(User $user)
    {
        return Notice::published()->whereHas('invitations', function($query) use($user) {
            $query->where('vendor_id', $user->vendor->id);
        })->count();
    }

    public static function bookmarks(User $user)
    {
        return Bookmark::whereUserId($user->id)->count();
    }

    public static function purchases(User $user)
    {
        return Notice::whereHas('purchases', function($query) use($user) {
            $query->where('vendor_id', $user->vendor->id);
        })->count();
    }

    public static function projects(User $user)
    {
        return Project::whereVendorId($user->vendor->id)->count();
    }
}
