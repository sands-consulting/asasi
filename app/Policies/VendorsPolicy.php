<?php

namespace App\Policies;

use App\Vendor;

class VendorsPolicy extends BasePolicy
{
    public function index()
    {
        return $this->user->ability(['Admin'], ['Vendor:List']);
    }

    public function show()
    {
        return $this->user->ability(['Admin'], ['Vendor:Show']);
    }

    public function create()
    {
        return $this->user->ability(['Admin'], ['Vendor:Create']);
    }

    public function store()
    {
        return true;
        return $this->create();
    }

    public function edit(Vendor $vendor)
    {
        return $this->user->ability(['Admin'], ['Vendor:Update']) && $vendor->name != 'Admin';
    }

    public function update(Vendor $vendor)
    {
        return $this->edit($vendor);
    }

    public function duplicate(Vendor $vendor)
    {
        return $this->user->ability(['Admin'], ['Vendor:Duplicate']);
    }

    public function revisions(Vendor $vendor)
    {
        return $this->user->ability(['Admin'], ['Vendor:Revisions']);
    }

    public function destroy(Vendor $vendor)
    {
        return $this->user->ability(['Admin'], ['Vendor:Delete']) && $vendor->name != 'Admin';
    }

    public function delete(Vendor $vendor)
    {
        return $this->destroy($vendor);
    }
}
