<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use App\Http\Requests\UserRequest;
use App\DataTables\UserLogsDataTable;
use App\Repositories\UsersRepository;
use App\DataTables\RevisionsDataTable;
use App\Repositories\UserLogsRepository;
use App\DataTables\UsersArchivedDataTable;

class UsersController extends Controller
{
    public function index(UsersDataTable $table)
    {
        return $table->render('admin.users.index');
    }

    public function archives(UsersArchivedDataTable $table)
    {
        return $table->render('admin.users.archives');
    }

    public function create(Request $request)
    {
        return view('admin.users.create', ['user' => new User]);
    }

    public function store(UserRequest $request)
    {
        $inputs             = $request->only('name', 'email', 'password');
        $inputs['password'] = bcrypt($request->input('password'));
        $user               = UsersRepository::create(new User, $inputs);

        if ($roles = $request->get('roles', [])) {
            $user->roles()->sync($roles);
        }

        UserLogsRepository::log(Auth::user(), 'Create', $user, $request->getClientIp());

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

    public function update(UserRequest $request, User $user)
    {
        $inputs = $request->only('name', 'email');

        if ($request->has('password')) {
            $inputs['password'] = bcrypt($request->input('password'));
        }

        $user = UsersRepository::update($user, $inputs);

        if ($roles = $request->get('roles', [])) {
            $user->roles()->sync($roles);
        }

        UserLogsRepository::log(Auth::user(), 'Update', $user, $request->getClientIp());

        return redirect()
            ->route('admin.users.edit', $user->id)
            ->with('notice', trans('users.notices.updated', ['name' => $user->name]));
    }

    public function destroy(Request $request, User $user)
    {
        UsersRepository::delete($user);
        UserLogsRepository::log(Auth::user(), 'Delete', $user, $request->getClientIp());

        return redirect()
            ->route('admin.users.index')
            ->with('notice', trans('users.notices.deleted', ['name' => $user->name]));
    }

    public function logs(User $user, UserLogsDataTable $table)
    {
        $table->setActionable($user);
        return $table->render('admin.users.logs', compact('user'));
    }

    public function revisions(User $user, RevisionsDataTable $table)
    {
        $table->setRevisionable($user);
        return $table->render('admin.users.revisions', compact('user'));
    }

    public function assume(Request $request, User $user)
    {
        UsersRepository::assume($user);

        if ($user->hasRole('Evaluator')) {
            return redirect()
                ->route('admin.evaluations.index')
                ->with('notice', trans('users.notices.assumed', ['name' => $user->name]));
        }

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

    public function restore(Request $request, User $user)
    {
        UsersRepository::restore($user);
        return redirect()
            ->back()
            ->with('notice', trans('users.notices.restored', ['name' => $user->name]));
    }
}
