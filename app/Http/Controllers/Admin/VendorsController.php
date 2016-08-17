<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\VendorsDataTable;
use App\Events\VendorApproved;
use App\Events\VendorRejected;
use App\Http\Requests\VendorRequest;
use App\Repositories\VendorsRepository;
use App\Setting;
use App\User;
use App\Vendor;
use Auth;
use Event;
use Illuminate\Http\Request;

class VendorsController extends Controller
{
    public function index(VendorsDataTable $table)
    {
        return $table->render('admin.vendors.index');
    }

    public function show(Vendor $vendor)
    {
        return view('admin.vendors.show', compact('vendor'));
    }
    
    public function create()
    {
        return view('admin.vendors.create');
    }

    public function store(VendorRequest $request)
    {
        $inputs = $request->all();
        $vendor = VendorsRepository::create(new Vendor, $inputs);

        return redirect()
            ->route('vendors.pending', $vendor->id)
            ->with('notice', trans('vendors.notices.created', ['name' => $vendor->name]));
    }

    public function edit(Vendor $vendor)
    {
        return view('admin.vendors.edit', compact('vendor'));
    }

    public function update(VendorRequest $request, Vendor $vendor)
    {
        $inputs = $request->all();

        $vendor = VendorsRepository::update($vendor, $inputs);

        return redirect()
            ->route('admin.vendors.edit', $vendor->id)
            ->with('notice', trans('vendors.notices.updated', ['name' => $vendor->name]));
    }

    public function destroy(Vendor $vendor)
    {
        VendorsRepository::delete($vendor);
        return redirect()
            ->route('admin.vendors.index')
            ->with('notice', trans('vendors.notices.deleted', ['name' => $vendor->name]));
    }

    public function logs(Vendor $vendor, VendorLogsDataTable $table)
    {
        $table->setActionable($vendor);
        return $table->render('admin.vendors.logs', compact('place'));
    }

    public function revisions(Vendor $vendor, RevisionsDataTable $table)
    {
        $table->setRevisionable($vendor);
        return $table->render('admin.vendors.revisions', compact('place'));
    }

    public function activate(Request $request, Vendor $vendor)
    {
        VendorsRepository::activate($vendor);
        return redirect()
            ->to($request->input('redirect_to', route('admin.vendors.show', $vendor->id)))
            ->with('notice', trans('vendors.notices.activated', ['name' => $vendor->name]));
    }

    public function deactivate(Request $request, Vendor $vendor)
    {
        VendorsRepository::deactivate($vendor);
        return redirect()
            ->to($request->input('redirect_to', route('admin.vendors.show', $vendor->id)))
            ->with('notice', trans('vendors.notices.deactivated', ['name' => $vendor->name]));
    }

    public function approve(Request $request, Vendor $vendor)
    {
        $inputs = $request->only(['redirect_to']);
        VendorsRepository::update($vendor, $inputs, ['status' => 'approved']);

        $role_id = Setting::where('key', 'vendor_role_id')->first()->value;
        User::find($vendor->user->id)->roles()->attach($role_id);

        Event::fire(new VendorApproved(Auth::user(), $vendor));

        return redirect()
            ->to($request->input('redirect_to', route('admin.vendors.show', $vendor->id)))
            ->with('notice', trans('vendors.notices.approved', ['name' => $vendor->name]));
    }

    public function reject(Request $request, Vendor $vendor)
    {
        $inputs = $request->only(['redirect_to', 'remarks']);
        VendorsRepository::update($vendor, $inputs, ['status' => 'rejected']);

        Event::fire(new VendorRejected(Auth::user(), $vendor, $inputs['remarks']));
        
        return redirect()
            ->to($request->input('redirect_to', route('admin.vendors.show', $vendor->id)))
            ->with('notice', trans('vendors.notices.rejected', ['name' => $vendor->name]));
    }
}
