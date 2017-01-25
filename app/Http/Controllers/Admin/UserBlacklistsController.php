<?php

namespace App\Http\Controllers\Admin;

use App\UserBlacklist;
use App\DataTables\UserBlacklistsDataTable;
use App\Http\Requests\UserBlacklistRequest;
use App\Services\UserBlacklistService;
use Illuminate\Http\Request;

class UserBlacklistsController extends Controller
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
