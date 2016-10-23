{!! Former::text('name')
	->label('allocations.attributes.name')
	->required() !!}
{!! Former::text('value')
	->label('allocations.attributes.value')
	->required() !!}
{!! Former::select('type_id')
	->label('allocations.attributes.type')
	->options(\App\AllocationType::lists('name', 'id'), null)
	->addClass('select2')
	->required() !!}
@if(!Auth::user()->hasPermission('allocation:organization'))
{!! Former::select('organization_id')
	->label('allocations.attributes.organization')
	->options(\App\Organization::getNestedList('name', 'id', '-'), null)
	->addClass('select2')
	->required() !!}
@endif
{!! Former::select('status')
	->label('allocations.attributes.status')
	->options(collect(trans('statuses'))->only('active', 'inactive'))
	->addClass('select2')
	->required() !!}
<div class="form-group">
	<div class="col-lg-10 col-sm-8 col-lg-offset-2 col-sm-offset-4">
		{!! Former::submit(trans('actions.save'))->addClass('bg-blue')->data_confirm(trans('app.confirmation')) !!}
		{!! link_to_route('admin.allocations.index', trans('actions.cancel'), [], ['class' => 'btn btn-default']) !!}
	</div>
</div>