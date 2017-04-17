<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\RevisionsDataTable;
use App\DataTables\UserHistoriesDataTable;
use App\DataTables\VendorsDataTable;
use App\Events\VendorApproved;
use App\Events\VendorRejected;
use App\Http\Requests\VendorRequest;
use App\Services\VendorService;
use App\Services\UserService;
use App\Services\UserHistoryService;
use App\Place;
use App\Setting;
use App\User;
use App\Vendor;
use Event;
use Illuminate\Http\Request;
use JavaScript;

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
        JavaScript::put([
            'admin' => true,
            'qualifications' => \App\QualificationType::with('codes')->active()->get(),
            'places' => Place::active()->get(),
        ]);
        $vendor = new Vendor;
        return view('admin.vendors.create', compact('vendor'));
    }

    public function store(VendorRequest $request)
    {
        $inputs = $request->except('address', 'accounts', 'employees', 'files', 'qualifications', 'shareholders');
        
        $vendor = VendorService::create(new Vendor, $inputs);
        VendorService::address($vendor, $request->input('address', []));
        VendorService::accounts($vendor, $request->input('accounts', []));
        VendorService::employees($vendor, $request->input('employees', []));
        VendorService::files($vendor, $request->input('files', []), $request->file('files'));
        VendorService::qualifications($vendor, $request->input('qualifications', []));
        VendorService::shareholders($vendor, $request->input('shareholders', []));

        UserHistoryService::log($request->user(), 'create', $vendor, $request->getClientIp());
        return redirect()
            ->route('admin.vendors.show', $vendor->id)
            ->with('notice', trans('vendors.notices.created', ['name' => $vendor->name]));
    }

    public function edit(Vendor $vendor)
    {
        JavaScript::put([
            'admin' => true,
            'qualifications' => \App\QualificationType::with('codes')->active()->get(),
            'places' => Place::active()->get(),
            'vendor' => [
                'accounts' => $vendor->accounts,
                'address' => $vendor->address,
                'employees' => $vendor->employees,
                'files' => $vendor->files()->with('upload')->get(),
                'qualifications' => $vendor->qualifications()->with('type')->get(),
                'qualification_codes' => $vendor->codes()->whereNull('parent_id')->with('type', 'children')->get(),
                'shareholders' => $vendor->shareholders,
            ]
        ]);
        return view('admin.vendors.edit', compact('vendor'));
    }

    public function update(VendorRequest $request, Vendor $vendor)
    {
        $inputs = $request->except('address', 'accounts', 'employees', 'files', 'qualifications', 'shareholders');
        
        VendorService::update($vendor, $inputs);
        VendorService::address($vendor, $request->input('address', []));
        VendorService::accounts($vendor, $request->input('accounts', []));
        VendorService::employees($vendor, $request->input('employees', []));
        VendorService::files($vendor, $request->input('files', []), $request->file('files'));
        VendorService::qualifications($vendor, $request->input('qualifications', []));
        VendorService::shareholders($vendor, $request->input('shareholders', []));

        UserHistoryService::log($request->user(), 'update', $vendor, $request->getClientIp());
        return redirect()
            ->route('admin.vendors.show', $vendor->id)
            ->with('notice', trans('vendors.notices.updated', ['name' => $vendor->name]));
    }

    public function destroy(Request $request, Vendor $vendor)
    {
        VendorService::delete($vendor);
        UserHistoryService::log($request->user(), 'Delete', $vendor, $request->getClientIp());
        if ($vendor->users) {
            foreach($vendor->users as $user) {
                UserService::delete($user);
            }
        }

        return redirect()
            ->route('admin.vendors.index')
            ->with('notice', trans('vendors.notices.deleted', ['name' => $vendor->name]));
    }

    public function histories(UserHistoriesDataTable $table, Vendor $vendor)
    {
        $table->setActionable($vendor);
        return $table->render('admin.vendors.histories', compact('vendor'));
    }

    public function revisions(Vendor $vendor, RevisionsDataTable $table)
    {
        $table->setRevisionable($vendor);
        return $table->render('admin.vendors.revisions', compact('vendor'));
    }

    public function approve(Request $request, Vendor $vendor)
    {
        $inputs = $request->only(['redirect_to']);
        VendorService::update($vendor, $inputs, ['status' => 'inactive']);
        UserHistoryService::log($request->user(), 'approve', $vendor, $request->getClientIp());

        Event::fire(new VendorApproved($vendor));

        return redirect()
            ->to($request->input('redirect_to', route('admin.vendors.show', $vendor->id)))
            ->with('notice', trans('vendors.notices.approved', ['name' => $vendor->name]));
    }

    public function reject(Request $request, Vendor $vendor)
    {
        $inputs = $request->only(['redirect_to', 'remarks']);
        VendorService::update($vendor, $inputs, ['status' => 'rejected']);
        UserHistoryService::log($request->user(), 'reject', $vendor, $request->getClientIp(), $inputs['remarks']);

        Event::fire(new VendorRejected($vendor, $inputs['remarks']));
        
        return redirect()
            ->to($request->input('redirect_to', route('admin.vendors.show', $vendor->id)))
            ->with('notice', trans('vendors.notices.rejected', ['name' => $vendor->name]));
    }

    public function suspend(Request $request, Vendor $vendor)
    {
        $inputs = $request->only(['redirect_to', 'remarks']);
        
        VendorService::update($vendor, $inputs, ['status' => 'suspended']);

        if ($vendor->users) {
            foreach($vendor->users as $user) {
                UserService::suspend($user);
            }
        }

        UserHistoryService::log($request->user(), 'suspend', $vendor, $request->getClientIp(), $inputs['remarks']);
        
        return redirect()
            ->to($request->input('redirect_to', route('admin.vendors.show', $vendor->id)))
            ->with('notice', trans('vendors.notices.suspended', ['name' => $vendor->name]));
    }

    public function activate(Request $request, Vendor $vendor)
    {
        $inputs = $request->only(['redirect_to']);
        
        VendorService::update($vendor, $inputs, ['status' => 'active']);

        foreach($vendor->users as $user) {
            UserService::activate($user);
        }

        UserHistoryService::log($request->user(), 'activate', $vendor, $request->getClientIp());
        
        return redirect()
            ->to($request->input('redirect_to', route('admin.vendors.show', $vendor->id)))
            ->with('notice', trans('vendors.notices.activated', ['name' => $vendor->name]));
    }
}
