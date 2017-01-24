<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\DataTables\RolesDataTable;
use App\Http\Requests\RoleRequest;
use App\Services\RoleService;
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
        return view('roles.edit', compact('role'));
    }

    public function store(RoleRequest $request)
    {
        $role = RoleService::create(new Role, $request->only('name', 'display_name', 'description'));
        $role->permissions()->sync($request->input('permissions', []));
        return redirect(route('admin.roles.index'))->with('notice', trans('roles.notices.created'));
    }

    public function show(Role $role)
    {
        return view('roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    public function update(RoleRequest $request, Role $role)
    {
        $role = RoleService::create(new Role, $request->only('display_name', 'description'));
        $role->permissions()->sync($request->input('permissions', []));
        return redirect(route('admin.roles.index'))->with('notice', trans('admin.roles.updated'));
    }

    public function destroy(Role $role)
    {
        RoleService::delete($role);
        return redirect(route('admin.roles.index'))->with('notice', trans('admin.roles.deleted'));
    }
}
