<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\DataTables\UsersDataTable;
use App\DataTables\UserHistoriesDataTable;
use App\DataTables\RevisionsDataTable;
use App\DataTables\UsersArchivedDataTable;
use App\Http\Requests\UserRequest;
use App\Services\UsersService;
use App\Services\UserHistoriesService;
use Illuminate\Http\Request;

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
        $user = new User;
        return view('admin.users.create', compact('user'));
    }

    public function store(UserRequest $request)
    {
        $inputs             = $request->only('name', 'email', 'password');
        $inputs['password'] = bcrypt($request->input('password'));
        $user               = UserService::create(new User, $inputs);

        $user->roles()->sync($request->input('roles', []));
        UserHistoryService::log($request->user(), 'create', $user, $request->getClientIp());

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

        $user = UserService::update($user, $inputs);

        if ($roles = $request->get('roles', [])) {
            $user->roles()->sync($roles);
        }

        UserHistoryService::log($request->user(), 'update', $user, $request->getClientIp());

        return redirect()
            ->route('admin.users.edit', $user->id)
            ->with('notice', trans('users.notices.updated', ['name' => $user->name]));
    }

    public function destroy(Request $request, User $user)
    {
        UserService::delete($user);
        UserHistoryService::log($request->user(), 'delete', $user, $request->getClientIp());

        return redirect()
            ->route('admin.users.index')
            ->with('notice', trans('users.notices.deleted', ['name' => $user->name]));
    }

    public function histories(User $user, UserHistoriesDataTable $table)
    {
        $table->setActionable($user);
        return $table->render('admin.users.histories', compact('user'));
    }

    public function revisions(User $user, RevisionsDataTable $table)
    {
        $table->setRevisionable($user);
        return $table->render('admin.users.revisions', compact('user'));
    }

    public function assume(Request $request, User $user)
    {
        UsersService::assume($user);

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
        UsersService::activate($user);
        return redirect()
            ->to($request->input('redirect_to', route('admin.users.show', $user->id)))
            ->with('notice', trans('users.notices.activated', ['name' => $user->name]));
    }

    public function suspend(Request $request, User $user)
    {
        UsersService::suspend($user);
        return redirect()
            ->to($request->input('redirect_to', route('admin.users.show', $user->id)))
            ->with('notice', trans('users.notices.suspended', ['name' => $user->name]));
    }

    public function restore(Request $request, User $user)
    {
        UserService::restore($user);
        return redirect()
            ->back()
            ->with('notice', trans('users.notices.restored', ['name' => $user->name]));
    }
}
