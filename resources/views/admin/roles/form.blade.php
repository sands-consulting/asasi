<div class="row">
	{!! Former::text('name')
		->label(trans('roles.attributes.name'))
		->disabled($role->exists)
		->required(!$role->exists)
		->addGroupClass('col-xs-12 col-sm-3') !!}
	{!! Former::text('display_name')
		->label(trans('roles.attributes.display_name'))
		->required()
		->addGroupClass('col-xs-12 col-sm-3') !!}
	{!! Former::text('description')
		->label(trans('roles.attributes.description'))
		->required()
		->addGroupClass('col-xs-12 col-sm-6') !!}
</div>

<div class="row">
	<div class="form-group col-xs-12">
		<label class="control-label">{{ trans('roles.attributes.permissions') }}</label>
		<div class="row row-eq-height">
		@foreach(\App\Permission::all()->groupBy('group') as $group => $perms)
			<div class="col-xs-12 col-sm-6">
				<div class="panel eq-element">
					<div class="panel-heading bg-blue-700">{{ str_titleize($group) }}</div>
					<div class="panel-body">
						<div class="row">
						@foreach($perms as $perm)
							<div class="col-xs-12 col-sm-6">
								<label class="matrix-label">
									{{ Form::checkbox('permissions[]', $perm->id, in_array($perm->id, $role->permissions->pluck('id')->toArray())) }}
									{{ $perm->description }}
								</label>
							</div>
						@endforeach
						</div>
					</div>
				</div>
			</div>
		@endforeach
		</div>
	</div>
</div>

{!! Former::submit(trans('actions.save'))->addClass('bg-blue')->data_confirm(trans('app.confirmation')) !!}
{!! link_to_route('admin.roles.index', trans('actions.cancel'), [], ['class' => 'btn btn-default']) !!}