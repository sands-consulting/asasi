<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\DataTables\RolesDataTable;
use App\DataTables\RevisionsDataTable;
use App\Http\Requests\RoleRequest;
use App\Services\RolesService;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index(RolesDataTable $table)
    {
        return $table->render('admin.roles.index');
    }

    public function create()
    {
        $role = new Role;
        return view('admin.roles.edit', compact('role'));
    }

    public function store(RoleRequest $request)
    {
        $role = RoleService::create(new Role, $request->only('name', 'display_name', 'description'));
        $role->permissions()->sync($request->input('permissions', []));
        return redirect()
            ->route('admin.roles.index')
            ->with('notice', trans('roles.notices.created', ['name' => $role->name]));
    }

    public function show(Role $role)
    {
        return view('admin.roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    public function update(RoleRequest $request, Role $role)
    {
        $role = RoleService::create(new Role, $request->only('display_name', 'description'));
        $role->permissions()->sync($request->input('permissions', []));
        return redirect()
            ->route('admin.roles.index')
            ->with('notice', trans('roles.notices.updated', ['name' => $role->name]));
    }

    public function destroy(Role $role)
    {
        RolesService::delete($role);
        return redirect()
            ->route('admin.roles.index')
            ->with('notice', trans('roles.notices.deleted', ['name' => $role->name]));
    }

    public function logs(Role $role, UserHistoriesDataTable $table)
    {
        $table->setActionable($role);
        return $table->render('admin.roles.logs', compact('role'));
    }

    public function revisions(Role $role, RevisionsDataTable $table)
    {
        $table->setRevisionable($role);
        return $table->render('admin.roles.revisions', compact('role'));
    }
}
