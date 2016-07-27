<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\DataTables\RolesDataTable;
use App\DataTables\RevisionsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Repositories\RolesRepository;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('policy');
    }

    public function index(RolesDataTable $table)
    {
        return $table->render('admin.roles.index');
    }

    public function create(Request $request)
    {
        return view('admin.roles.create', ['role' => new Role]);
    }

    public function store(RoleRequest $request)
    {
        $inputs = $request->only('name', 'display_name', 'description');
        $role   = RolesRepository::create(new Role, $inputs);

        if ($permissions = $request->get('permissions', []))
        {
            $role->permissions()->sync($permissions);
        }

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
        $inputs = $request->only('display_name', 'description');
        $role   = RolesRepository::update($role, $inputs);

        if ($permissions = $request->get('permissions', []))
        {
            $role->permissions()->sync($permissions);
        }

        return redirect()
            ->route('admin.roles.index')
            ->with('notice', trans('roles.notices.updated', ['name' => $role->name]));
    }

    public function destroy(Role $role)
    {
        RolesRepository::delete($role);
        return redirect()
            ->route('admin.roles.index')
            ->with('notice', trans('roles.notices.deleted', ['name' => $role->name]));
    }

    public function logs(Role $role, UserLogsDataTable $table)
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
