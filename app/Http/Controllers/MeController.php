<?php

namespace App\Http\Controllers;

use App\Http\Requests\MeRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;

class MeController extends Controller
{
	public function edit()
	{
		return view('me.edit');
	}

	public function update(Request $request, Guard $auth)
	{
		$inputs	= $request->only('name');

		if(isset($inputs['password']))
		{
			$inputs['password']	= bcrypt($inputs['password']);
		}
		else
		{
			unset($inputs['password']);
		}

		$request->user()->update($inputs);

		return redirect()
                ->route('me')
                ->with('notice', trans('me.notices.updated'));
	}

	public function resume(Request $request, Guard $auth)
	{
		$current_user = $auth->user();
        $original_user = UsersService::resume();
        return redirect()
                ->route('admin.users.show', $current_user->id)
                ->with('notice', trans('me.notices.resumed', ['name' => $original_user->name]));
	}

    public function contact(Guard $auth)
    {
        return view('me.contact');
    }

    public function storeContact(Request $request)
    {
    }

    public function notifications(Request $request)
    {
    }
}
