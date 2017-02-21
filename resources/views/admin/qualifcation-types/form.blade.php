{!! Former::text('name')
	->label('qualification-code-types.attributes.name')
	->required() !!}
{!! Former::text('code')
	->label('qualification-code-types.attributes.code')
	->required() !!}
{!! Former::select('parent_id')
	->label('qualification-code-types.attributes.parent')
	->options(App\QualificationType::getOptions('name', 'id', '-')) !!}
{!! Former::select('type')
	->label('qualification-code-types.attributes.type')
	->options(trans('qualification-code-types.types'))
	->addClass('select2')
	->required() !!}
{!! Former::select('status')
	->label('qualification-code-types.attributes.status')
	->options(collect(trans('statuses'))->only('active', 'inactive'))
	->addClass('select2')
	->required() !!}
<div class="form-group">
	<div class="col-lg-10 col-sm-8 col-lg-offset-2 col-sm-offset-4">
		{!! Former::submit(trans('actions.save'))->addClass('bg-blue')->data_confirm(trans('app.confirmation')) !!}
		{!! link_to_route('admin.qualification-code-types.index', trans('actions.cancel'), [], ['class' => 'btn btn-default']) !!}
	</div>
</div>