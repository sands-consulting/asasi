<div class="row">
	<div class="col-xs-12 col-md-6">
		<div class="panel panel-flat">
			<div class="panel-body">
				{!! Former::text('email')->label('users.attributes.email')->required(!$user->exists) !!}
				{!! Former::text('name')->label('users.attributes.name')->required() !!}
				{!! Former::password('password')->label('users.attributes.password')->required(!$user->exists) !!}
				{!! Former::password('password_confirmation')->label('users.attributes.password_confirmation')->required(!$user->exists) !!}
			</div>
		</div>
	</div>

	<div class="col-xs-12 col-md-6">
		<div class="panel panel-default">
			<div class="panel-body">
				{!! Former::select('roles[]')->label('users.attributes.roles')->options(App\Role::options())->select($user->roles()->pluck('id'))->multiple(true)->required()->id('roles') !!}
				<div class="form-group required" v-if="hasOrganization">
					<label for="organizations" class="control-label">{{ trans('users.attributes.organization') }}<sup>*</sup></label>
					<select required="required" id="organizations" data-url="{{ version('v1')->route('organizations.index') }}" name="organizations[]" class="form-control">
						@if($user->organization)<option value="{{ $user->organization->id }}">{{ $user->organization->name }}</option>@endif
					</select>
				</div>
				<div class="form-group required" v-if="hasVendor">
					<label for="organizations" class="control-label">{{ trans('users.attributes.vendor') }}<sup>*</sup></label>
					<select required="required" id="vendors" data-url="{{ version('v1')->route('vendors.index') }}" name="vendors[]" class="form-control">
						@if($user->vendor)<option value="{{ $user->vendor->id }}">{{ $user->vendor->registration_number }} - {{ $user->vendor->name }}</option>@endif
					</select>
				</div>
			</div>
		</div>
	</div>
</div>

{!! Former::submit(trans('actions.save'))->addClass('bg-blue')->data_confirm(trans('app.confirmation')) !!}
{!! link_to_route('admin.users.show', trans('actions.cancel'), $user->id, ['class' => 'btn bg-slate-300']) !!}
