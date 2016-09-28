<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\VendorsDataTable;
use App\Events\VendorApproved;
use App\Events\VendorRejected;
use App\Http\Requests\VendorRequest;
use App\Repositories\VendorsRepository;
use App\Repositories\UsersRepository;
use App\Repositories\UserLogsRepository;
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

    public function approve(Request $request, Vendor $vendor)
    {
        $inputs = $request->only(['redirect_to']);
        VendorsRepository::update($vendor, $inputs, ['status' => 'approved']);

        $role_id = Setting::where('key', 'vendor_role_id')->first()->value;
        User::find($vendor->user->id)->roles()->attach($role_id);
        User::find($vendor->user->id)->vendors()->attach($role_id);

        UserLogsRepository::log(Auth::user(), 'Approve Vendor', $vendor, $request->getClientIp());

        Event::fire(new VendorApproved(Auth::user(), $vendor));

        return redirect()
            ->to($request->input('redirect_to', route('admin.vendors.show', $vendor->id)))
            ->with('notice', trans('vendors.notices.approved', ['name' => $vendor->name]));
    }

    public function reject(Request $request, Vendor $vendor)
    {
        $inputs = $request->only(['redirect_to', 'remarks']);
        VendorsRepository::update($vendor, $inputs, ['status' => 'rejected']);

        UserLogsRepository::log(Auth::user(), 'Reject Vendor', $vendor, $request->getClientIp(), $inputs['remarks']);

        Event::fire(new VendorRejected(Auth::user(), $vendor, $inputs['remarks']));
        
        return redirect()
            ->to($request->input('redirect_to', route('admin.vendors.show', $vendor->id)))
            ->with('notice', trans('vendors.notices.rejected', ['name' => $vendor->name]));
    }

    public function suspend(Request $request, Vendor $vendor)
    {
        $inputs = $request->only(['redirect_to', 'remarks']);
        
        VendorsRepository::update($vendor, $inputs, ['status' => 'suspended']);

        foreach($vendor->users as $user) {
            UsersRepository::suspend($user);
        }

        UserLogsRepository::log(Auth::user(), 'Suspend Vendor', $vendor, $request->getClientIp(), $inputs['remarks']);
        
        return redirect()
            ->to($request->input('redirect_to', route('admin.vendors.show', $vendor->id)))
            ->with('notice', trans('vendors.notices.suspended', ['name' => $vendor->name]));
    }

    public function activate(Request $request, Vendor $vendor)
    {
        $inputs = $request->only(['redirect_to']);
        
        VendorsRepository::update($vendor, $inputs, ['status' => 'approved']);

        foreach($vendor->users as $user) {
            UsersRepository::activate($user);
        }

        UserLogsRepository::log(Auth::user(), 'Activate Vendor', $vendor, $request->getClientIp());
        
        return redirect()
            ->to($request->input('redirect_to', route('admin.vendors.show', $vendor->id)))
            ->with('notice', trans('vendors.notices.activated', ['name' => $vendor->name]));
    }

    public function blacklist(Request $request, Vendor $vendor)
    {
        $inputs = $request->only(['redirect_to', 'remarks']);
        
        VendorsRepository::update($vendor, $inputs, ['status' => 'blacklisted']);
        UserLogsRepository::log(Auth::user(), 'Blacklist Vendor', $vendor, $request->getClientIp());
        
        return redirect()
            ->to($request->input('redirect_to', route('admin.vendors.show', $vendor->id)))
            ->with('notice', trans('vendors.notices.blacklisted', ['name' => $vendor->name]));
    }

    public function unblacklist(Request $request, Vendor $vendor)
    {
        $inputs = $request->only(['redirect_to']);
        
        VendorsRepository::update($vendor, $inputs, ['status' => 'approved']);
        UserLogsRepository::log(Auth::user(), 'Unblacklist Vendor', $vendor, $request->getClientIp());
        
        return redirect()
            ->to($request->input('redirect_to', route('admin.vendors.show', $vendor->id)))
            ->with('notice', trans('vendors.notices.activated', ['name' => $vendor->name]));
    }
}
