<?php

namespace App\Http\Controllers;

use App\DataTables\Portal\BookmarksDataTable;
use App\Http\Requests\MeRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;

class MeController extends Controller
{
	public function edit()
	{
		return view('me.edit');
	}

	public function update(MeRequest $request, Guard $auth)
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
                ->with('notice', trans('me.flash.updated'));
	}

	public function resume(Request $request, Guard $auth)
	{
		$current_user = $auth->user();
        $original_user = UserService::resume();
        return redirect()
                ->route('admin.users.show', $current_user->id)
                ->with('notice', trans('me.flash.resumed', ['name' => $original_user->name]));
	}

	public function bookmarks(Request $request, BookmarksDataTable $table)
	{
		$table->user_id = $request->user()->id;
		return $table->render('me.bookmarks');
	}

	public function notifications(Request $request)
    {
    	return view('me.notifications');
    }
}
