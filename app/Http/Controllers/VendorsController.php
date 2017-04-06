<?php

namespace App\Http\Controllers;

use App\DataTables\Portal\VendorEligiblesDataTable;
use App\DataTables\Portal\VendorInvitationsDataTable;
use App\DataTables\Portal\VendorPurchasesDataTable;
use App\Events\VendorApplied;
use App\Http\Requests\VendorRequest;
use App\Services\VendorService;
use App\Vendor;
use Auth;
use Illuminate\Http\Request;

class VendorsController extends Controller
{
    public function show(Vendor $vendor)
    {
        return view('vendors.show', compact('vendor'));
    }

    public function pending(Vendor $vendor)
    {
        return view('vendors.pending', compact('vendor'));
    }

    public function edit(Vendor $vendor)
    {
        return view('vendors.edit', ['vendor' => $vendor]);
    }

    public function update(VendorRequest $request, Vendor $vendor)
    {
        $inputs = $request->all();
        $vendor = VendorService::update($vendor, $inputs, ['status' => 'draft']);
        VendorService::accounts($vendor, $request->input('accounts', []));
        VendorService::employees($vendor, $request->input('employees', []));
        VendorService::qualificationCodes($vendor, $request->input('qualification_codes', []));
        VendorService::shareholders($vendor, $request->input('shareholders', []));

        if (isset($inputs['submit']))
        {
            $vendor = VendorService::update($vendor, $inputs, ['status' => 'pending']);
            event(new VendorApplied($vendor));

            return redirect()
                ->route('vendors.pending', $vendor->id);
        }
        else
        {
            return redirect()
                ->route('vendors.show', $vendor->id)
                ->with('notice', trans('vendors.notices.public.saved', ['name' => $vendor->name]));
        }


    }

    public function eligibles(VendorEligiblesDataTable $table, Vendor $vendor)
    {
        $table->vendor_id = $vendor->id;
        return $table->render('vendors.eligibles', compact('vendor'));
    }

    public function invitations(VendorInvitationsDataTable $table, Vendor $vendor)
    {
        $table->vendor_id = $vendor->id;
        return $table->render('vendors.invitations', compact('vendor'));
    }

    public function purchases(VendorPurchasesDataTable $table, Vendor $vendor)
    {
        $table->vendor_id = $vendor->id;
        return $table->render('vendors.purchases', compact('vendor'));
    }
}
