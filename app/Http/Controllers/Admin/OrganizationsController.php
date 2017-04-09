<?php

namespace App\Http\Controllers\Admin;

use App\Organization;
use App\DataTables\OrganizationsDataTable;
use App\DataTables\RevisionsDataTable;
use App\Http\Requests\OrganizationRequest;
use App\Services\OrganizationService;
use App\Services\UserHistoryService;
use Illuminate\Http\Request;

class OrganizationsController extends Controller
{
    public function index(OrganizationsDataTable $table)
    {
        return $table->render('admin.organizations.index');
    }

    public function create(Request $request)
    {
        return view('admin.organizations.create', ['organization' => new Organization]);
    }

    public function store(OrganizationRequest $request)
    {
        $inputs = $request->only('name', 'short_name', 'parent_id', 'status');
        $organization = OrganizationService::create(new Organization, $inputs);
        UserHistoryService::log($request->user(), 'create', $organization, $request->getClientIp());
        return redirect()
            ->route('admin.organizations.index')
            ->with('notice', trans('organizations.notices.created', ['name' => $organization->name]));
    }

    public function edit(Organization $organization)
    {
        return view('admin.organizations.edit', compact('organization'));
    }

    public function update(OrganizationRequest $request, Organization $organization)
    {
        $inputs = $request->only('name', 'short_name', 'parent_id', 'status');
        $organization = OrganizationService::update($organization, $inputs);
        UserHistoryService::log($request->user(), 'update', $organization, $request->getClientIp());
        return redirect()
            ->route('admin.organizations.index')
            ->with('notice', trans('organizations.notices.updated', ['name' => $organization->name]));
    }

    public function destroy(Request $request, Organization $organization)
    {
        OrganizationService::delete($organization);
        UserHistoryService::log($request->user(), 'delete', $organization, $request->getClientIp());
        return redirect()
            ->route('admin.organizations.index')
            ->with('notice', trans('organizations.notices.deleted', ['name' => $organization->name]));
    }

    public function histories(Organization $organization, OrganizationLogsDataTable $table)
    {
        $table->setActionable($organization);
        return $table->render('admin.organizations.histories', compact('organization'));
    }

    public function revisions(Organization $organization, RevisionsDataTable $table)
    {
        $table->setRevisionable($organization);
        return $table->render('admin.organizations.revisions', compact('organization'));
    }

    public function suspend(Request $request, Organization $organization)
    {
        OrganizationService::suspend($organization);
        UserHistoryService::log($request->user(), 'suspend', $organization, $request->getClientIp());
        return redirect()
            ->to($request->input('redirect_to', route('admin.organizations.show', $organization->id)))
            ->with('notice', trans('organizations.notices.suspended', ['name' => $organization->name]));
    }
}
