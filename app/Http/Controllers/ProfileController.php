<?php

namespace App\Http\Controllers;

use App\Repositories\UsersRepository;
use App\Http\Requests\AccountRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Guard $auth)
    {
        return view('profile.show', ['user' => $auth->user()]);
    }

    public function edit(Guard $auth)
    {
        return view('profile.edit', ['user' => $auth->user()]);
    }

    public function update(AccountRequest $request, Guard $auth)
    {
        $inputs = $request->only('name');
        if($request->has('password'))
        {
            $inputs['password'] = bcrypt($request->input('password'));
        }

        $user = UsersRepository::update($auth->user(), $inputs);
        return redirect()
            ->route('profile')
            ->with('notice', trans('profile.notices.updated'));
    }

    public function resume(Request $request, Guard $auth)
    {
        $current_user = $auth->user();
        $original_user = UsersRepository::resume();
        return redirect()
                ->route('admin.users.show', $current_user->id)
                ->with('notice', trans('profile.notices.resumed', ['name' => $original_user->name]));
    }
}
