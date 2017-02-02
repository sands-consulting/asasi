<?php

namespace App\Http\Controllers\Admin;

use App\Organization;
use App\DataTables\OrganizationsDataTable;
use App\DataTables\RevisionsDataTable;
use App\Http\Requests\OrganizationRequest;
use App\Services\OrganizationsService;
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
        $inputs         = $request->only('name', 'short_name', 'parent_id');
        $organization   = OrganizationsService::create(new Organization, $inputs);
        return redirect()
            ->route('admin.organizations.index')
            ->with('notice', trans('organizations.notices.created', ['name' => $organization->name]));
    }

    public function show(Organization $organization)
    {
        return view('admin.organizations.show', compact('organization'));
    }

    public function edit(Organization $organization)
    {
        return view('admin.organizations.edit', compact('organization'));
    }

    public function update(OrganizationRequest $request, Organization $organization)
    {
        $inputs         = $request->only('name', 'short_name', 'parent_id');
        $organization   = OrganizationsService::update($organization, $inputs);
        return redirect()
            ->route('admin.organizations.index')
            ->with('notice', trans('organizations.notices.updated', ['name' => $organization->name]));
    }

    public function destroy(Organization $organization)
    {
        OrganizationsService::delete($organization);
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

    public function activate(Request $request, Organization $organization)
    {
        OrganizationsService::activate($organization);
        return redirect()
            ->to($request->input('redirect_to', route('admin.organizations.show', $organization->id)))
            ->with('notice', trans('organizations.notices.activated', ['name' => $organization->name]));
    }

    public function deactivate(Request $request, Organization $organization)
    {
        OrganizationsService::deactivate($organization);
        return redirect()
            ->to($request->input('redirect_to', route('admin.organizations.show', $organization->id)))
            ->with('notice', trans('organizations.notices.deactivated', ['name' => $organization->name]));
    }

    public function suspend(Request $request, Organization $organization)
    {
        OrganizationsService::suspend($organization);
        return redirect()
            ->to($request->input('redirect_to', route('admin.organizations.show', $organization->id)))
            ->with('notice', trans('organizations.notices.suspended', ['name' => $organization->name]));
    }
}
