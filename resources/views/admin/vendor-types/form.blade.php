{!! Former::text('incorporation_authority')
	->label('vendor-types.attributes.incorporation_authority')
	->required() !!}
{!! Former::text('incorporation_type')
	->label('vendor-types.attributes.incorporation_type')
	->required() !!}
{!! Former::select('status')
	->label('vendor-types.attributes.status')
	->options(collect(trans('statuses'))->only('active', 'inactive'))
	->addClass('select2')
	->required() !!}
<div class="form-group">
    <div class="col-lg-10 col-sm-8 col-lg-offset-2 col-sm-offset-4">
        {!! Former::submit(trans('actions.save'))->addClass('bg-blue')->data_confirm(trans('app.confirmation')) !!}
        {!! link_to_route('admin.vendor-types.index', trans('actions.cancel'), [], ['class' => 'btn btn-default']) !!}
    </div>
</div>