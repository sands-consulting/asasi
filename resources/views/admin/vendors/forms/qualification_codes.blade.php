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
					<input type="checkbox" name="qualification_codes[{{ $type->code }}][{{ $code->id }}]" value="1"{{ request(implode('.', ['qualification_codes', $type->code, $code->id]), $vendor->qualificationCodes()->whereId($code->id)->count()) ? 'checked="checked"' : '' }}>
					<strong>{{ $code->code }}</strong> {{ $code->name }}
				</label>
			</div>

			@foreach($type->getImmediateDescendants() as $child)
			<div class="panel panel-flat ml-15">
				<div class="panel-heading">
					<h6 class="panel-title">{{ $child->name }}</h6>
				</div>
				<div class="panel-body">
					@foreach($child->codes()->whereStatus('active')->orderBy('code')->get() as $childCode)
					<div class="checkbox">
						<label>
							<input type="checkbox" name="qualification_codes[{{ $type->code }}][{{ $code->id }}][{{ $childCode->id }}]" value="1"{{ request(implode('.', ['qualification_codes', $type->code, $code->id, $childCode->id]), $vendor->qualificationCodes()->whereId($childCode->id)->count()) ? 'checked="checked"' : '' }}>
							<strong>{{ $childCode->code }}</strong> {{ $childCode->name }}
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
	<?php $code = $type->codes()->first(); ?>
	<div class="panel panel-flat">
		<div class="panel-heading">
			<div class="checkbox">
				<label>
					<input type="checkbox" name="qualification_codes[{{ $type->code }}]" value="{{ $code->id }}" {{ request(implode('.', ['qualification_codes', $type->code]), $vendor->qualificationCodes()->whereId($code->id)->count()) ? 'checked="checked"' : '' }}>
					{{ $type->name }}
				</label>
			</div>
		</div>
	</div>
	@endif

@endforeach
</div>