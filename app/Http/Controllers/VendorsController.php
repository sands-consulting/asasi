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
    public function create()
    {
        return view('vendors.create');
    }

    public function store(VendorRequest $request)
    {
        $inputs = $request->all();
        $vendor = VendorsRepository::create(new Vendor, $inputs, ['user_id' => $request->user()->id]);

        return redirect()
            ->route('home')
            ->with('notice', trans('vendors.notices.public.saved', ['name' => $vendor->name]));
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

    public function show(Vendor $vendor)
    {
        return view('vendors.show', compact('vendor'));
    }

    public function subscriptions(Vendor $vendor, VendorSubscriptionsDataTable $table)
    {
        $table->vendor = $vendor;
        return $table->render('vendors.subscriptions', compact('vendor'));
    }

    public function qualificationCodes(Vendor $vendor)
    {
        return view('vendors.qualification_codes', compact('vendor'));
    }

    public function completeApplication(Request $request, Vendor $vendor)
    {
        if (is_complete_form($vendor)) {
            $vendor = VendorsRepository::update($vendor, [], ['status' => 'pending']);
            return redirect()
                ->route('home.index')
                ->with('notice', trans('vendors.notices.public.complete-application', ['name' => $vendor->name]));
        } else {
            return redirect()
                ->route('vendors.edit', $vendor->id)
                ->with('alert', trans('vendors.notices.public.incomplete-application', ['name' => $vendor->name]));
        }
    }

    public function cancelApplication(Vendor $vendor)
    {
        if ($vendor->status == 'pending') {
            VendorsRepository::update($vendor, ['status' => 'draft']);
            event(new VendorCancelled($vendor));

            return redirect()
                ->route('vendors.edit', $vendor->id)
                ->with('notice', trans('vendors.notices.public.canceled', ['name' => $vendor->name]));
        } else {
            return redirect()
                ->route('home.index')
                ->with('alert', trans('vendors.notices.public.cancel-fail'));
        }
    }

    public function pending(Vendor $vendor)
    {
        return view('vendors.pending', compact('vendor'));
    }

    public function profile()
    {
        $vendor = Auth::user()->vendor;
        return view('vendors.profile', compact('vendor'));
    }
}
