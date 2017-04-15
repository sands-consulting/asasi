<?php

namespace App\Policies;

use App\Notice;
use App\User;
use Carbon\Carbon;
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

    // tD

    public function summaryByType(User $auth, Notice $notice)
    {
        return $this->show($auth, $notice);
    }

    public function summaryEvaluators(User $auth, Notice $notice)
    {
        return $this->show($auth, $notice);
    }

    public function award(User $auth, Notice $notice)
    {
        return $this->show($auth, $notice);
    }

    public function storeAward(User $auth, Notice $notice)
    {
        return $this->award($auth, $notice);
    }

    public function purchase(User $auth, Notice $notice)
    {
    	if($auth->hasAllPermissions(['access:vendor', 'access:cart']))
    	{
    		$eligibles = $notice->eligibles()->get();

    		if($notice->eligibles()->count() == 0 || $notice->eligibles()->whereVendorId($auth->vendor->id)->first())
    		{
    			$now = Carbon::now();
    			
    			// if($notice->)
    		}
    		else
    		{
    			return false;
    		}
    	}
    	else
    	{
    		return false;
    	}
    }
}