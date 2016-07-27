{!! Former::text('name')
	->label('organizations.attributes.name')
	->required() !!}
{!! Former::text('short_name')
	->label('organizations.attributes.short_name')->required() !!}
{!! Former::select('parent_id')
	->label(trans('organizations.attributes.parent'))
	->options(\App\Organization::getNestedList('name', 'id', '-'), null)
	->placeholder(trans('organizations.views.form.select_parent'))
	->addClass('select2') !!}
<div class="form-group">
	<div class="col-lg-10 col-sm-8 col-lg-offset-2 col-sm-offset-4">
		{!! Former::submit(trans('actions.save'))->addClass('bg-blue')->data_confirm(trans('app.confirmation')) !!}
		{!! link_to_route('admin.organizations.show', trans('actions.cancel'), $organization->id, ['class' => 'btn btn-default']) !!}
	</div>
</div>