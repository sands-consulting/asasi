<div role="tabpanel" class="tab-pane" id="tab-vendor-qualifications">
<table class="table table-bordered table-condensed">
@foreach(\App\QualificationType::active()->orderBy('name')->whereDepth(0)->get() as $type)
	<thead class="bg-blue-700">
		<tr>
			<th colspan="2">{{ $type->name }}</th>
		</tr>
	</thead>
	<tbody>
	@if($type->validity || $type->reference_one || $type->reference_two)
		@if($type->reference_one)
		<tr>
			<th class="col-xs-3">{{ $type->reference_one }}</th>
			<td><input type="text" class="form-control" name"qualifications[{{ $type->id }}]['reference_one']" v-model="qualifications.{{ $type->code }}.reference_one"></td>
		</tr>
		@endif

		@if($type->reference_two)
		<tr>
			<th class="col-xs-3">{{ $type->reference_two }}</th>
			<td><input type="text" class="form-control" name"qualifications[{{ $type->id }}]['reference_two']" v-model="qualifications.{{ $type->code }}.reference_two"></td>
		</tr>
		@endif

		@if($type->validity)
		<tr>
			<th class="col-xs-3">{{ trans('qualification-types.attributes.start_at') }}</th>
			<td><input type="text" class="form-control" name"qualifications[{{ $type->id }}]['start_at']" v-model="qualifications.{{ $type->code }}.start_at"></td>
		</tr>
		<tr>
			<th class="col-xs-3">{{ trans('qualification-types.attributes.end_at') }}</th>
			<td><input type="text" class="form-control" name"qualifications[{{ $type->id }}]['end_at']" v-model="qualifications.{{ $type->code }}.end_at"></td>
		</tr>
		@endif
		@if($type->type == 'list')
		<tr>
			<th>{{ trans('qualification-types.attributes.codes') }}</th>
			<td class="qualification-codes">
				<template v-for="(code, index1) in qualifications.{{ $type->code }}.codes">
				<div class="input-group">
					<select v-bind:name="'qualifications[{{ $type->id }}][' + index1 + '][code_id]'" class="form-control" v-model="code.code_id">
						<option value=""></option>
						@foreach($type->codes()->active()->get() as $code)<option value="{{ $code->id }}">{{ $code->label }}</option>@endforeach
					</select>
					<span class="input-group-btn">
						<a href="#" class="btn btn-danger legitRipple" @click.prevent="deleteCode('{{ $type->code }}', index1)"><i class="icon-cross"></i></a>
					</span>
				</div>
				@if($type->children()->count() > 0)
				<div class="children">
					<template v-for="(child, index2) in code.children">
					<div class="input-group">
						<select v-bind:name="'qualifications[{{ $type->id }}][' + index1 + '][code_id][children][' + index2 + '][code_id]'" class="form-control" v-model="child.code_id">
							<option value=""></option>
							@foreach($type->children()->active()->get() as $child)
								<optgroup label="{{ $child->name }}">
									@foreach($child->codes()->active()->get() as $childCode)<option value="{{ $childCode->id }}">{{ $childCode->label }}</option>@endforeach
								</optgroup>
							@endforeach
						</select>
						<span class="input-group-btn">
							<a href="#" class="btn btn-danger legitRipple btn-add" @click.prevent="deleteChildCode('{{ $type->code }}', index1, index2)"><i class="icon-cross"></i></a>
						</span>
					</div>
					</template>
					<a href="#" class="btn btn-xs bg-blue-700 btn-add" @click.prevent="addChildCode('{{ $type->code }}', index1)">{{ trans('actions.add-child') }}</a>
				</div>
				@endif
				</template>
				<a href="#" class="btn btn-sm bg-blue-700 btn-add" @click.prevent="addCode('{{ $type->code }}')">{{ trans('actions.add') }}</a>
			</td>
		</tr>
		@endif
	@endif
	</tbody>
@endforeach
</table>
</table>
</div>
