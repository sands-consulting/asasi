{!! Former::text('name')
	->label('places.attributes.name')
	->required() !!}
{!! Former::select('type')
	->label('places.attributes.type')
	->options(collect(\App\Place::$types)->reduce(function($carry, $type) {
		$carry[$type] = trans('places.types.' . $type);
		return $carry;
	}))
	->addClass('select2')
	->required() !!}
{!! Former::text('code_2')
	->label('places.attributes.code_2') !!}
{!! Former::text('code_3')
	->label('places.attributes.code_3') !!}
{!! Former::select('parent_id')
	->label(trans('places.attributes.parent'))
	->options(\App\Place::getNestedList('name', 'id', '-'), null)
	->placeholder(trans('places.views.form.select_parent'))
	->addClass('select2') !!}
<div class="form-group">
	<div class="col-lg-10 col-sm-8 col-lg-offset-2 col-sm-offset-4">
		{!! Former::submit(trans('actions.save'))->addClass('bg-blue')->data_confirm(trans('app.confirmation')) !!}
		{!! link_to_route('admin.places.show', trans('actions.cancel'), $place->id, ['class' => 'btn btn-default']) !!}
	</div>
</div>