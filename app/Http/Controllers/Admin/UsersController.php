<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\DataTables\UsersDataTable;
use App\DataTables\UserHistoriesDataTable;
use App\DataTables\RevisionsDataTable;
use App\DataTables\UsersArchivedDataTable;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use App\Services\UserHistoryService;
use Illuminate\Http\Request;
use JavaScript;

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
        JavaScript::put([
            'roles' => \App\Role::with(['permissions' => function($q) {
                    $q->whereGroup('has');
                }])->get()->pluck('permissions', 'id')->transform(function($item, $key) {
                    return $item->pluck('name')->toArray();
                })->toArray()
        ]);
        return view('admin.users.create', compact('user'));
    }

    public function store(UserRequest $request)
    {
        $inputs             = $request->only('name', 'email', 'password');
        $inputs['password'] = bcrypt($request->input('password'));
        $user               = UserService::create(new User, $inputs);

        $user->organizations()->sync($request->input('organizations', []));
        $user->roles()->sync($request->input('roles', []));
        $user->vendors()->sync($request->input('vendors', []));
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
        JavaScript::put([
            'roles' => \App\Role::with(['permissions' => function($q) {
                    $q->whereGroup('has');
                }])->get()->pluck('permissions', 'id')->transform(function($item, $key) {
                    return $item->pluck('name')->toArray();
                })->toArray()
        ]);
        return view('admin.users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $inputs = $request->only('name', 'email');

        if ($request->has('password')) {
            $inputs['password'] = bcrypt($request->input('password'));
        }

        $user = UserService::update($user, $inputs);
        $user->organizations()->sync($request->input('organizations', []));
        $user->roles()->sync($request->input('roles', []));
        $user->vendors()->sync($request->input('vendors', []));

        UserHistoryService::log($request->user(), 'update', $user, $request->getClientIp());

        return redirect()
            ->route('admin.users.show', $user->id)
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
        UserService::assume($user);

        if ($user->hasPermission('access:administration')) {
            if($user->hasPermission('dashboard:user')) {
                return redirect()->to(route('admin'));
            }

            if ($user->hasPermission('evaluation:index')) {
                return redirect()->to(route('admin.evaluations.index'));
            }
        }

        return redirect()
            ->to('/')
            ->with('notice', trans('users.notices.assumed', ['name' => $user->name]));
    }

    public function activate(Request $request, User $user)
    {
        UserService::activate($user);
        return redirect()
            ->to($request->input('redirect_to', route('admin.users.show', $user->id)))
            ->with('notice', trans('users.notices.activated', ['name' => $user->name]));
    }

    public function suspend(Request $request, User $user)
    {
        UserService::suspend($user);
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
