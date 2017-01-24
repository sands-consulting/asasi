<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\DataTables\UsersDataTable;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(UsersDataTable $table)
    {
        return $table->render('admin.users.index');
    }

    public function create()
    {
        $user = new User;
        return view('users.edit', compact('user'));
    }

    public function store(UserRequest $request)
    {
        $user = UserService::create(new User, $request->only('name', 'display_name', 'description'));
        $user->permissions()->sync($request->input('permissions', []));
        return redirect(route('admin.users.index'))->with('notice', trans('users.notices.created'));
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $user = UserService::create(new User, $request->only('display_name', 'description'));
        $user->permissions()->sync($request->input('permissions', []));
        return redirect(route('admin.users.index'))->with('notice', trans('admin.users.updated'));
    }

    public function destroy(User $user)
    {
        UserService::delete($user);
        return redirect(route('admin.users.index'))->with('notice', trans('admin.users.deleted'));
    }
}
