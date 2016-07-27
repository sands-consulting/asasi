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
        return view('vendors.index');
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
            ->route('vendors.index')
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
            ->with('notice', trans('vendors.notices.public.submitted', ['name' => $vendor->name]));
    }

    public function apply(VendorRequest $request, Vendor $vendor)
    {
        // Fixme: find how to validate if only form want to be submmited to approver.
        $inputs = $request->all();
        $vendor = VendorsRepository::update($vendor, $inputs, ['status' => 'pending-approval']);

        return redirect()
            ->route('vendors.pending', $vendor->id)
            ->with('notice', trans('vendors.notices.public.submitted', ['name' => $vendor->name]));
    }

    public function pending(Vendor $vendor)
    {
        return view('vendors.pending', compact('vendor'));
    }
}
