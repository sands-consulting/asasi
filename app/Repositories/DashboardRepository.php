<?php 

namespace App\Repositories;

use App\Bookmark;
use App\Notice;
use App\Project;
use App\User;

class DashboardRepository extends BaseRepository
{
    public static function getAllNumber(User $user)
    {
        return Notice::published()->count();
    }

    public static function getEligiblesNumber(User $user)
    {
        return '1';
    }

    public static function getInvitationsNumber(User $user)
    {
        return Notice::leftJoin('notice_invitation', 'notice_invitation.vendor_id', '=', 'notices.id')
            ->where('notice_invitation.vendor_id', $user->vendor->id)
            ->where('status', 'limited')
            ->count();
    }

    public static function getBookmarksNumber(User $user)
    {
        return Bookmark::whereUserId($user->id)->count();
    }

    public static function getPurchasesNumber(User $user)
    {
        return $vendor = $user->vendor->notices->count();
    }

    public static function getProjectsNumber(User $user)
    {
        return Project::whereVendorId($user->vendor->id)->count();
    }
}