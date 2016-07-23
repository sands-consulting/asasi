<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\UsersRepository;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('policy');
    }

    public function index(UsersDataTable $table)
    {
        return $table->render('admin.users.index');
    }

    public function create(Request $request)
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $input             = $request->all();
        $input['password'] = app('hash')->make($input['password']);
        $user              = UsersRepository::create(new User(), $input);
        if ($roles = $request->get('roles')) {
            $user->roles()->sync($roles);
        }
        return redirect()
            ->route('admin.users.show', $user->id)
            ->with('notice', trans('users.notices.created', ['name' => $user->name]));
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $user = UsersRepository::update($user, $request->all());
        if ($roles = $request->get('roles')) {
            $user->roles()->sync($roles);
        }
        return redirect()
            ->route('admin.users.edit', $user->id)
            ->with('notice', trans('users.notices.updated', ['name' => $user->name]));
    }

    public function destroy(User $user)
    {
        UsersRepository::delete($user);
        return redirect()
            ->route('admin.users.index')
            ->with('notice', trans('users.notices.deleted', ['name' => $user->name]));
    }

    public function logs(User $user)
    {
        return view('admin.users.logs', compact('user'));
    }

    public function revisions(User $user)
    {
        return view('admin.users.revisions', compact('user'));
    }

    public function assume(User $user)
    {
        UsersRepository::assume($user);
        return redirect()
            ->to('/')
            ->with('notice', trans('users.notices.assumed', ['name' => $user->name]));
    }

    public function activate(Request $request, User $user)
    {
        UsersRepository::activate($user);
        return redirect()
            ->to($request->input('redirect_to', route('admin.users.show', $user->id)))
            ->with('notice', trans('users.notices.activated', ['name' => $user->name]));
    }

    public function suspend(Request $request, User $user)
    {
        UsersRepository::suspend($user);
        return redirect()
            ->to($request->input('redirect_to', route('admin.users.show', $user->id)))
            ->with('notice', trans('users.notices.suspended', ['name' => $user->name]));
    }
}
