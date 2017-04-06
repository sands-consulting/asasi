<div role="tabpanel" class="tab-pane" id="tab-vendor-qualifications">
@foreach(\App\QualificationType::active()->orderBy('name')->whereDepth(0)->get() as $type)
<div class="panel-body">
	<h6>{{ $type->name }}</h6>

	@if($type->validity || $type->reference_one || $type->reference_two)
	<table class="table table-bordered table-condensed">
		@if($type->reference_one)
		<tr>
			<th class="col-xs-3">{{ $type->reference_one }}</th>
			<td><input type="text" placeholder="{{ $type->reference_one }}" class="form-control"></td>
		</tr>
		@endif

		@if($type->reference_two)
		<tr>
			<th class="col-xs-3">{{ $type->reference_two }}</th>
			<td><input type="text" placeholder="{{ $type->reference_two }}" class="form-control"></td>
		</tr>
		@endif

		@if($type->validity)
		<tr>
			<th class="col-xs-3">{{ trans('qualification-types.attributes.start_at') }}</th>
			<td><input type="text" class="form-control"></td>
		</tr>
		<tr>
			<th class="col-xs-3">{{ trans('qualification-types.attributes.end_at') }}</th>
			<td><input type="text" class="form-control"></td>
		</tr>
		@endif
	</table>
	@endif

</div>
@endforeach
</table>
</div>
