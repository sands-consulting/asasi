{!! Former::text('name')
	->label('qualification-types.attributes.name')
	->required() !!}
{!! Former::text('code')
	->label('qualification-types.attributes.code')
	->required() !!}
{!! Former::select('parent_id')
	->label('qualification-types.attributes.parent')
	->options(App\QualificationType::getOptions('name', 'id', '-'))
	->placeholder(trans('qualification-types.placeholders.parent'))
	->addClass('select2') !!}
{!! Former::select('type')
	->label('qualification-types.attributes.type')
	->options(trans('qualification-types.types'))
	->addClass('select2')
	->required() !!}
{!! Former::select('status')
	->label('qualification-types.attributes.status')
	->options(collect(trans('statuses'))->only('active', 'inactive'))
	->addClass('select2')
	->required() !!}
<div class="form-group">
	<div class="col-lg-10 col-sm-8 col-lg-offset-2 col-sm-offset-4">
		{!! Former::submit(trans('actions.save'))->addClass('bg-blue')->data_confirm(trans('app.confirmation')) !!}
        {!! link_to_route('admin.qualification-types.index', trans('actions.cancel'), [], ['class' => 'btn btn-default']) !!}
	</div>
</div>