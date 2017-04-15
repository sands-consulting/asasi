<?php

namespace App\Policies;

use App\Notice;
use App\User;
use Carbon\Carbon;
use Cart;
use Illuminate\Auth\Access\HandlesAuthorization;

class NoticePolicy
{
    use HandlesAuthorization;

    public function index(User $auth)
    {
        return $auth->hasPermission('notice:index');
    }

    public function create(User $auth)
    {
        return $auth->hasPermission('notice:create');
    }

    public function store(User $auth)
    {
        return $this->create($auth);
    }

    public function show(User $auth, Notice $notice)
    {
        return $this->checkOrganization($auth, $notice, 'notice:show');
    }

    public function edit(User $auth, Notice $notice)
    {
        return $auth->hasPermission('notice:update');
    }

    public function update(User $auth, Notice $notice)
    {
        return $this->edit($auth, $notice);
    }

    public function duplicate(User $auth, Notice $notice)
    {
        return $auth->hasPermission('notice:duplicate');
    }

    public function revisions(User $auth, Notice $notice)
    {
        return $auth->hasPermission('notice:revisions');
    }

    public function histories(User $auth, Notice $notice)
    {
        return $auth->hasPermission('notice:histories');
    }

    public function destroy(User $auth, Notice $notice)
    {
        return $auth->hasPermission('notice:delete');
    }

    public function publish(User $auth, Notice $notice)
    {
        return $auth->hasPermission('notice:publish') && !in_array($notice->status, ['published', 'cancelled']);
    }

    public function unpublish(User $auth, Notice $notice)
    {
        return $auth->hasPermission('notice:unpublish') && $notice->status == 'published';
    }

    public function cancel(User $auth, Notice $notice)
    {
        return $auth->hasPermission('notice:cancel') && !in_array($notice->status, ['draft', 'cancelled']);
    }

    public function saveEvaluator(User $auth, Notice $notice)
    {
        return $auth->hasPermission('notice:create');
    }

    public function summary(User $auth, Notice $notice)
    {
        return $this->show($auth, $notice);
    }

    public function eligible(User $auth, Notice $notice)
    {
        return $this->show($auth, $notice);
    }

    public function invitation(User $auth, Notice $notice)
    {
        return $this->show($auth, $notice);
    }

    public function bookmark(User $auth, Notice $notice)
    {
        return $auth->hasPermission('access:vendor');
    }

    public function award(User $auth, Notice $notice)
    {
        return $auth->hasPermission('notice:award');
    }

    public function purchase(User $auth, Notice $notice)
    {
        if(!$auth->hasPermission('access:vendor'))
        {
            return false;
        }

        // Already Purchased
        if($notice->purchases()->whereVendorId($auth->vendor->id)->count() > 0)
        {
            return false;
        }

        // Already in Cart
        $items = Cart::search(function ($item, $rowId) use($notice) {
            return $item->id === $notice->id;
        });

        if(count($items) > 0)
        {
            return false;
        }

        if($notice->status != 'published')
        {
            return false;
        }

        if($notice->published_at->gt(Carbon::now()))
        {
            return false;
        }

        if($notice->purchased_at->gt(Carbon::now()))
        {
            return false;
        }

        if($notice->expired_at->lte(Carbon::now()))
        {
            return false;
        }

        // Invitation
        if($notice->invitation)
        {
            return $notice->invitations()->whereVendorId($auth->vendor->id)->count() > 0;
        }

        // Qualification
        if($notice->qualificationCodes()->count() > 0 && $notice->eligibles()->whereVendorId($auth->vendor->id)->count() == 0)
        {
            return false;
        }

        if($notice->eligibles()->count() > 0 && $notice->eligibles()->whereVendorId($auth->vendor->id)->count() == 0)
        {
            return false;
        }

        return true;
    }

    public function checkOrganization(User $auth, Notice $notice, $perm)
    {
        if ( ! $auth->hasPermission($perm)) {
            return false;
        }

        if ($auth->hasPermission('notice:organization')) {
            return $auth->organizations->pluck('id')->has($notice->organization_id);
        }

        return true;
    }
}