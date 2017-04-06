{!! Former::text('name')
	->label('tax-codes.attributes.name')
	->required(true) !!}
{!! Former::text('code')
	->label('tax-codes.attributes.code')
	->required(true) !!}
{!! Former::text('rate')
	->label('tax-codes.attributes.rate')
	->required(true) !!}
<div class="form-group">
    <div class="col-lg-10 col-sm-8 col-lg-offset-2 col-sm-offset-4">
        {!! Former::submit(trans('actions.save'))->addClass('bg-blue')->data_confirm(trans('app.confirmation')) !!}
        {!! link_to_route('admin.tax-codes.index', trans('actions.cancel'), $tax_code->id, ['class' => 'btn btn-default']) !!}
    </div>
</div>