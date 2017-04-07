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
use JavaScript;

class VendorsController extends Controller
{
    public function __construct()
    {
        $this->middleware('redirect.application')->except(['edit', 'update']);
        $this->middleware('redirect.pending');
        $this->middleware('redirect.subscription');
    }

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
        JavaScript::put([
            'qualifications' => \App\QualificationType::with('codes')->active()->get(),
            'vendor' => [
                'accounts' => $vendor->accounts,
                'employees' => $vendor->employees,
                'qualifications' => $vendor->qualifications()->with('codes')->get(),
                'shareholders' => $vendor->shareholders,
            ]
        ]);
        return view('vendors.edit', ['vendor' => $vendor]);
    }

    public function update(VendorRequest $request, Vendor $vendor)
    {
        $inputs = $request->all();
        $status = isset($inputs['submit']) ? 'pending' : 'draft';
        
        VendorService::update($vendor, $inputs, ['status' => $status]);
        VendorService::address($vendor, $request->input('address', []));
        VendorService::accounts($vendor, $request->input('accounts', []));
        VendorService::employees($vendor, $request->input('employees', []));
        VendorService::qualifications($vendor, $request->input('qualifications', []));
        VendorService::shareholders($vendor, $request->input('shareholders', []));

        if ('pending' == $status)
        {
            event(new VendorApplied($vendor));
            return redirect()
                ->route('vendors.pending', $vendor->id);
        }
        else
        {
            return redirect()
                ->back()
                ->with('notice', trans('vendors.notices.saved', ['name' => $vendor->name]));
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
