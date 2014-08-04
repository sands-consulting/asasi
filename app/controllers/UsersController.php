<?php

class UsersController extends \BaseController {

	public $set_password_message = 'Password set succesfully.';
	public $set_confirmation_message = 'Activation set succesfully.';
	public $change_password_invalid_message = 'Invalid Old Password.';
	public $change_password_message = 'Password changed succesfully.';

	/**
	 * Display a listing of users
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!User::canList())
		{
			return $this->_access_denied();
		}
		if(Request::ajax())
		{
			$users_under_me = Auth::user()->get_authorized_userids(User::$show_authorize_flag);
			if(empty($users_under_me)) {
				$users = User::whereNotNull('users.created_at');	
			} else {
				$users = User::whereIn('users.user_id', $users_under_me);	
			}
			$users = $users->select(['users.id', 'users.username', 'organization_units.name', DB::raw('count(assigned_roles.id)'), 'users.confirmed'])
				-> leftJoin('assigned_roles', 'assigned_roles.user_id', '=', 'users.id')
				-> leftJoin('organization_units', 'organization_units.id', '=', 'users.organizationunit_id')
				-> groupBy('users.id');
			return Datatables::of($users)
        ->add_column('actions', '{{View::make("users.actions-row", compact("id", "confirmed"))->render()}}')
				->remove_column('id')
				->make();
			return Datatables::of($users)->make();
		}
		Asset::push('js', 'datatables');
		return View::make('users.index');
	}

	/**
	 * Show the form for creating a new user
	 *
	 * @return Response
	 */
	public function create()
	{
		if(Request::ajax())
		{
			return $this->_ajax_denied();
		}
		if(!User::canCreate())
		{
			return $this->_access_denied();
		}
		return View::make('users.create');
	}

	/**
	 * Store a newly created user in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		User::setRules('store');
		$data = Input::all();
		if(!User::canCreate())
		{
			return $this->_access_denied();
		}
		$data['confirmed'] = 1;
		$data['roles'] = isset($data['roles']) ? $data['roles'] : [];
		$user = new User;
		$user->fill($data);
		if(!$user->save()) {
			return $this->_validation_error($user);
		}
		$user->roles()->sync($data['roles']);
		if(Request::ajax())
		{
			return Response::json($user, 201);
		}
		return Redirect::route('users.index')
			->with('notification:success', $this->created_message);
	}

	/**
	 * Display the specified user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::findOrFail($id);
		if(!$user->canShow())
		{
			return $this->_access_denied();
		}
		if(Request::ajax())
		{
			return $user;
		}
		Asset::push('js', 'show');
		return View::make('users.show', compact('user'));
	}

	/**
	 * Show the form for editing the specified user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::find($id);
		if(Request::ajax())
		{
			return $this->_ajax_denied();
		}
		if(!$user->canUpdate())
		{
			return $this->_access_denied();
		}
		return View::make('users.edit', compact('user'));
	}

	/**
	 * Update the specified user in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = User::findOrFail($id);
		$data = Input::all();
		if(!$user->canUpdate())
		{
			return $this->_access_denied();
		}
		User::setRules('update');
		$user->fill($data);
		if(!$user->updateUniques())
		{
			return $this->_validation_error($user);
		}
		$data['roles'] = isset($data['roles']) ? $data['roles'] : [];
		$user->roles()->sync($data['roles']);
		if(Request::ajax())
		{
			return $user;
		}
		return Redirect::route('users.index')
			->with('notification:success', $this->updated_message);
	}

	/**
	 * Remove the specified user from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::findOrFail($id);
		
		if(!$user->canDelete())
		{
			return $this->_access_denied();
		}
		if(!$user->delete()){
			return $this->_delete_error();
		}
		if(Request::ajax())
		{
			return Response::json($this->deleted_message);
		}
		return Redirect::route('users.index')
			->with('notification:success', $this->deleted_message);
	}

	/**
	 * ====================================================================================================================
	 * Additional methods
	 * ====================================================================================================================
	 */

	public function profile()
	{
		return View::make('users.profile', ['controller' => 'Profile', 'user' => Auth::user()]);	
	}

	public function getSetPassword($id)
	{
		$user = User::findOrFail($id);
		if(Request::ajax())
		{
			return $this->_ajax_denied();
		}
		if(!$user->canSetPassword())
		{
			return $this->_access_denied();
		}
		return View::make('users.set-password', compact('user'));
	}

	public function putSetPassword($id)
	{
		$user = User::findOrFail($id);
		$data = Input::all();
		if(!$user->canSetPassword())
		{
			return $this->_ajax_denied();
		}
		User::setRules('setPassword');
		if(!$user->update($data)){
			$this->_validation_error($user);
		}
		if(Request::ajax())
		{
			return Response::json($this->set_password_message);
		}
		return Redirect::action('users.show', $user->id)
			->with('notification:success', $this->set_password_message);
	}

	public function putSetConfirmation($id = null)
	{
		$user = User::findOrFail($id);
		$data = Input::all();
		if(!$user->canSetConfirmation())
		{
			return $this->_access_denied();
		}
		User::setRules('setConfirmation');
		if(!$user->update($data)){
			return $this->_validation_error($user);
		}
		if(Request::ajax())
		{
			return Response::json($this->set_confirmation_message);
		}
		return Redirect::action('users.show', $user->id)
			->with('notification:success', $this->set_confirmation_message);
	}

	public function getChangePassword()
	{
		$user = Auth::user();
		if(!$user->canSetPassword())
		{
			return $this->_access_denied();
		}
		return View::make('users.change-password', compact('user'));
	}

	public function putChangePassword()
	{
		$user = Auth::user();
		$data = Input::all();
		if(!$user->canSetPassword())
		{
			return $this->_access_denied();
		}
		User::setRules('changePassword');
		if(!Hash::check($data['old_password'], $user->password))
		{
			if(Request::ajax())
			{
				return Response::json($this->change_password_invalid_message, 400);
			}
			return Redirect::back()
				->withErrors($validator)
				->withInput()
				->with('notification:danger', $this->change_password_invalid_message);
		}
		if(!$user->update($data))
		{
			return $this->_validation_error($data);
		}
		if(Request::ajax())
		{
			return Response::json($this->set_password_message);
		}
		return Redirect::action('UsersController@profile', $user->id)
			->with('notification:success', $this->set_password_message);
	}

	public function __construct()
	{
		parent::__construct();
		View::share('controller', 'UsersController');
	}

}
