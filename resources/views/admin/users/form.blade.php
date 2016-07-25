{!! Former::text('email')->label('users.attributes.email')->required(!$user->exists) !!}
{!! Former::text('name')->label('users.attributes.name')->required() !!}
{!! Former::password('password')->label('users.attributes.password')->required(!$user->exists) !!}
{!! Former::password('password_confirmation')->label('users.attributes.password_confirmation')->required(!$user->exists) !!}
<div class="form-group">
	<label for="roles" class="control-label col-lg-2 col-sm-4">{{ trans('users.attributes.roles') }}</label>
	<div class="col-lg-10 col-sm-8">
		@foreach(\App\Role::all() as $role)
		<div class="checkbox">
			<label>{{ Form::checkbox('roles[]', $role->id, in_array($role->id, request('roles', $user->roles->lists('id')->toArray()))) }} {{ $role->display_name }}</label>
		</div>
		@endforeach
	</div>
</div>
<div class="form-group">
	<div class="col-lg-10 col-sm-8 col-lg-offset-2 col-sm-offset-4">
		{!! Former::submit(trans('actions.save'))->addClass('bg-blue')->data_confirm(trans('app.confirmation')) !!}
		{!! link_to_route('admin.users.show', trans('actions.cancel'), $user->id, ['class' => 'btn btn-default']) !!}
	</div>
</div>