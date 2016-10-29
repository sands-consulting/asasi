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
        $vendor = VendorsRepository::update($vendor, $inputs);

        return redirect()
            ->route('vendors.edit', $vendor->id)
            ->with('notice', trans('vendors.notices.public.saved', ['name' => $vendor->name]));
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
