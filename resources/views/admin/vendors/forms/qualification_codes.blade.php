<div role="tabpanel" class="tab-pane" id="vendor-qualification-codes">
@foreach(\App\QualificationCodeType::roots()->activeCodes()->get() as $type)

	@if($type->type == 'list')
	<div class="panel panel-white">
		<div class="panel-heading">
			<h6 class="panel-title">{{ $type->name }}</h6>
		</div>
		
		<div class="panel-body">
			@foreach($type->codes()->whereStatus('active')->orderBy('code')->get() as $code)
			<div class="checkbox">
				<label>
					<input type="checkbox" name="qualification_codes[{{ $type->code }}][]" value="{{ $code->id }}">
					<strong>{{ $code->code }}</strong> {{ $code->name }}
				</label>
			</div>

			@foreach($type->getImmediateDescendants() as $child)
			<div class="panel panel-flat ml-15">
				<div class="panel-heading">
					<h6 class="panel-title">{{ $child->name }}</h6>
				</div>
				<div class="panel-body">
					@foreach($child->codes()->whereStatus('active')->orderBy('code')->get() as $code)
					<div class="checkbox">
						<label>
							<input type="checkbox" name="qualification_codes[{{ $type->code }}][{{ $code->id }}][]" value="{{ $code->id }}">
							<strong>{{ $code->code }}</strong> {{ $code->name }}
						</label>
					</div>
					@endforeach
				</div>
			</div>
			@endforeach
			@endforeach
		</div>
	</div>

	@endif

	@if($type->type == 'boolean')
	<div class="panel panel-flat">
		<div class="panel-heading">
			<div class="checkbox">
				<label>
					<input type="checkbox" name="qualification_codes[{{ $type->code }}]" value="{{ $type->codes()->first()->id }}">
					{{ $type->name }}
				</label>
			</div>
		</div>
	</div>
	@endif

@endforeach
</div>