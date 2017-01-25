<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\RevisionsDataTable;
use App\DataTables\UserHistoriesDataTable;
use App\DataTables\VendorSubscriptionsDataTable;
use App\DataTables\VendorsDataTable;
use App\Events\VendorApproved;
use App\Events\VendorRejected;
use App\Http\Requests\VendorRequest;
use App\Notificators\VendorApprovedNotificator;
use App\Notificators\VendorRejectedNotificator;
use App\Services\VendorsService;
use App\Services\UsersService;
use App\Services\UserHistoriesService;
use App\Setting;
use App\User;
use App\Vendor;
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
        $vendor = VendorsService::create(new Vendor, $inputs);

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

        $vendor = VendorsService::update($vendor, $inputs);
        UserHistoriesService::log($request->user(), 'Update', $vendor, $request->getClientIp());
        return redirect()
            ->route('admin.vendors.edit', $vendor->id)
            ->with('notice', trans('vendors.notices.updated', ['name' => $vendor->name]));
    }

    public function destroy(Request $request, Vendor $vendor)
    {
        VendorsService::delete($vendor);
        UserHistoriesService::log($request->user(), 'Delete', $vendor, $request->getClientIp());
        if ($vendor->users) {
            foreach($vendor->users as $user) {
                UsersService::delete($user);
            }
        }

        return redirect()
            ->route('admin.vendors.index')
            ->with('notice', trans('vendors.notices.deleted', ['name' => $vendor->name]));
    }

    public function logs(Vendor $vendor, UserHistoriesDataTable $table)
    {
        $table->setActionable($vendor);
        return $table->render('admin.vendors.logs', compact('vendor'));
    }

    public function revisions(Vendor $vendor, RevisionsDataTable $table)
    {
        $table->setRevisionable($vendor);
        return $table->render('admin.vendors.revisions', compact('vendor'));
    }

    public function approve(Request $request, Vendor $vendor)
    {
        $inputs = $request->only(['redirect_to']);
        VendorsService::update($vendor, $inputs, ['status' => 'inactive']);
        UserHistoriesService::log($request->user(), 'Approve', $vendor, $request->getClientIp());

        Event::fire(new VendorApproved($vendor));

        return redirect()
            ->to($request->input('redirect_to', route('admin.vendors.show', $vendor->id)))
            ->with('notice', trans('vendors.notices.approved', ['name' => $vendor->name]));
    }

    public function reject(Request $request, Vendor $vendor)
    {
        $inputs = $request->only(['redirect_to', 'remarks']);
        VendorsService::update($vendor, $inputs, ['status' => 'rejected']);
        UserHistoriesService::log($request->user(), 'Reject', $vendor, $request->getClientIp(), $inputs['remarks']);

        Event::fire(new VendorRejected($vendor, $inputs['remarks']));
        
        return redirect()
            ->to($request->input('redirect_to', route('admin.vendors.show', $vendor->id)))
            ->with('notice', trans('vendors.notices.rejected', ['name' => $vendor->name]));
    }

    public function suspend(Request $request, Vendor $vendor)
    {
        $inputs = $request->only(['redirect_to', 'remarks']);
        
        VendorsService::update($vendor, $inputs, ['status' => 'suspended']);

        if ($vendor->users) {
            foreach($vendor->users as $user) {
                UsersService::suspend($user);
            }
        }

        UserHistoriesService::log($request->user(), 'Suspend', $vendor, $request->getClientIp(), $inputs['remarks']);
        
        return redirect()
            ->to($request->input('redirect_to', route('admin.vendors.show', $vendor->id)))
            ->with('notice', trans('vendors.notices.suspended', ['name' => $vendor->name]));
    }

    public function activate(Request $request, Vendor $vendor)
    {
        $inputs = $request->only(['redirect_to']);
        
        VendorsService::update($vendor, $inputs, ['status' => 'active']);

        foreach($vendor->users as $user) {
            UsersService::activate($user);
        }

        UserHistoriesService::log($request->user(), 'Activate Vendor', $vendor, $request->getClientIp());
        
        return redirect()
            ->to($request->input('redirect_to', route('admin.vendors.show', $vendor->id)))
            ->with('notice', trans('vendors.notices.activated', ['name' => $vendor->name]));
    }

    public function blacklist(Request $request, Vendor $vendor)
    {
        $inputs = $request->only(['redirect_to', 'remarks']);
        
        VendorsService::update($vendor, $inputs, ['status' => 'blacklisted']);
        UserHistoriesService::log($request->user(), 'Blacklist', $vendor, $request->getClientIp(), $inputs['remarks']);
        
        return redirect()
            ->to($request->input('redirect_to', route('admin.vendors.show', $vendor->id)))
            ->with('notice', trans('vendors.notices.blacklisted', ['name' => $vendor->name]));
    }

    public function unblacklist(Request $request, Vendor $vendor)
    {
        $inputs = $request->only(['redirect_to']);
        
        VendorsService::update($vendor, $inputs, ['status' => 'active']);
        UserHistoriesService::log($request->user(), 'Unblacklist', $vendor, $request->getClientIp());
        
        return redirect()
            ->to($request->input('redirect_to', route('admin.vendors.show', $vendor->id)))
            ->with('notice', trans('vendors.notices.activated', ['name' => $vendor->name]));
    }

    public function qualificationCodes(Vendor $vendor)
    {
        return view('admin.vendors.subscriptions', compact('vendor'));
    }

    public function subscriptions(Vendor $vendor, VendorSubscriptionsDataTable $table)
    {
        $table->vendor = $vendor;
        return $table->render('admin.vendors.subscriptions', compact('vendor'));
    }
}
