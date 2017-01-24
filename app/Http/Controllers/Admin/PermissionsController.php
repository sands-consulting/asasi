<?php

namespace App\Http\Controllers\Admin;

use App\Permission;
use App\DataTables\PermissionsDataTable;
use App\Http\Requests\PermissionRequest;
use App\Services\PermissionService;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    public function index(PermissionsDataTable $table)
    {
        return $table->render('admin.permissions.index');
    }

    public function create()
    {
        $permission = new Permission;
        return view('permissions.edit', compact('permission'));
    }

    public function store(PermissionRequest $request)
    {
        $permission = PermissionService::create(new Permission, $request->only('name', 'description'));
        $permission->roles()->sync($request->input('roles', []));
        return redirect(route('admin.permissions.index'))->with('notice', trans('permissions.notices.created'));
    }

    public function show(Permission $permission)
    {
        return view('permissions.show', compact('permission'));
    }

    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact('permission'));
    }

    public function update(PermissionRequest $request, Permission $permission)
    {
        $permission = PermissionService::create(new Permission, $request->only('description'));
        $permission->roles()->sync($request->input('roles', []));
        return redirect(route('admin.permissions.index'))->with('notice', trans('admin.permissions.updated'));
    }

    public function destroy(Permission $permission)
    {
        PermissionService::delete($permission);
        return redirect(route('admin.permissions.index'))->with('notice', trans('admin.permissions.deleted'));
    }
}
