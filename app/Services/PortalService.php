<?php 

namespace App\Services;

use App\Bookmark;
use App\News;
use App\Notice;
use App\Project;
use App\User;
use Carbon\Carbon;

class PortalService
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
        return Notice::published()->whereInvitation(1)->whereHas('invitations', function($query) use($user) {
            $query->where('vendor_id', $user->vendor->id);
        })->count();
    }

    public static function bookmarks(User $user)
    {
        return $user->bookmarks()->count();
    }

    public static function purchases(User $user)
    {
        return Notice::whereHas('purchases', function($query) use($user) {
            $query->where('vendor_id', $user->vendor->id);
        })->count();
    }

    public static function submissions(User $user)
    {
        return $user->vendor
            ->purchases()
            ->doesntHave('submission', 'and', function ($query) {
                $query->where('status', 'completed');
            })
            ->count();
    }

    public static function projects(User $user)
    {
        return Project::whereVendorId($user->vendor->id)->count();
    }

    public static function banners()
    {
        return News::published()->orderBy('created_at', 'desc')->take(10)->get();
    }
}
