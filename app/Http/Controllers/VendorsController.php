<?php

namespace App\Http\Controllers;

use App\Vendor;
use App\Http\Requests\VendorRequest;
use App\Repositories\VendorsRepository;
use Auth;
use Illuminate\Http\Request;

class VendorsController extends Controller
{
    public function index()
    {
        return view('vendors.create');
    }

    public function create()
    {
        return view('vendors.create');
    }

    public function store(VendorRequest $request)
    {
        $inputs = $request->all();
        $vendor = VendorsRepository::create(new Vendor, $inputs, ['user_id' => Auth::user()->id]);

        return redirect()
            ->route('home.index')
            ->with('notice', trans('vendors.notices.public.saved', ['name' => $vendor->name]));
    }

    public function edit(Vendor $vendor)
    {
        return view('vendors.edit', ['vendor' => $vendor]);
    }

    public function update(VendorRequest $request, Vendor $vendor)
    {
        $inputs = $request->all();
        $vendor = VendorsRepository::update($vendor, $inputs);

        return redirect()
            ->route('vendors.edit', $vendor->id)
            ->with('notice', trans('vendors.notices.public.saved', ['name' => $vendor->name]));
    }

    public function completeApplication(Request $request, Vendor $vendor)
    {
        // Fixme: find how to validate if only form want to be submmited to approver.
        $inputs = $request->all();
        $vendor = VendorsRepository::update($vendor, $inputs, ['status' => 'pending-approval']);

        return redirect()
            ->route('home.index')
            ->with('notice', trans('vendors.notices.public.complete-application', ['name' => $vendor->name]));
    }

    public function cancelApplication(Vendor $vendor)
    {
        VendorsRepository::delete($vendor);
        return redirect()
            ->route('vendors.index')
            ->with('notice', trans('vendors.notices.deleted', ['name' => $vendor->name]));
    }

    public function pending(Vendor $vendor)
    {
        return view('vendors.pending', compact('vendor'));
    }
}
