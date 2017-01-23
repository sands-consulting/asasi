<?php

namespace App\Http\Controllers;

use App\DataTables\VendorSubscriptionsDataTable;
use App\Events\VendorApplied;
use App\Events\VendorCancelled;
use App\Http\Requests\VendorRequest;
use App\Notificators\VendorAppliedNotificator;
use App\Repositories\VendorsRepository;
use App\Vendor;
use Auth;
use Illuminate\Http\Request;
use Route;

class VendorsController extends Controller
{
    public function show(Vendor $vendor)
    {
        return view('vendors.show', compact('vendor'));
    }

    public function edit(Vendor $vendor)
    {
        return view('vendors.edit', ['vendor' => $vendor]);
    }

    public function update(VendorRequest $request, Vendor $vendor)
    {
        $inputs = $request->all();
        $vendor = VendorsRepository::update($vendor, $inputs, ['status' => 'draft']);
        VendorsRepository::accounts($vendor, $request->input('accounts', []));
        VendorsRepository::employees($vendor, $request->input('employees', []));
        VendorsRepository::qualificationCodes($vendor, $request->input('qualification_codes', []));
        VendorsRepository::shareholders($vendor, $request->input('shareholders', []));

        if (isset($inputs['submit'])) {
            $vendor = VendorsRepository::update($vendor, $inputs, ['status' => 'pending']);
            event(new VendorApplied($vendor));
        }

        return redirect()
            ->route('home')
            ->with('notice', trans('vendors.notices.public.saved', ['name' => $vendor->name]));
    }

    public function eligibles(Vendor $vendor)
    {
        return view('vendors.eligibles', compact('vendor'));
    }

    public function invitations(Vendor $vendor)
    {
        return view('vendors.invitations', compact('vendor'));
    }

    public function purchases(Vendor $vendor)
    {
        return view('vendors.purchases', compact('vendor'));
    }

    public function bookmarks(Vendor $vendor)
    {
        return view('vendors.bookmarks', compact('vendor'));
    }
}
