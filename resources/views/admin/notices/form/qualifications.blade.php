<div role="tabpanel" class="tab-pane" id="tab-notice-qualifications">
	<table class="table table-bordered table-striped table-vtop">
		<tbody>
			<template v-for="(qualification, index) in qualifications">
				<tr>
					<td class="col-xs-2">
						<select v-bind:name="'qualification-codes[' + index + '][group_rule]'" class="form-control" v-model="qualification.group_rule">
							@foreach(trans('qualification-codes.group-rules') as $value => $label)<option value="{{ $value }}">{{ $label }}</option>@endforeach
						</select>
					</td>
					<td class="qualification-codes">
						<template v-for="(code, index1) in qualification.codes">
							<div class="input-group">
								<input type="hidden" v-bind:name="'qualification-codes[' + index + '][codes][' + index1 + '][id]'" v-model="code.id">
								<select v-bind:name="'qualification-codes[' + index + '][codes][' + index1 + '][code_id]'" class="form-control" v-model="code.code_id">
									<option value=""></option>
									@foreach(App\QualificationType::active()->get() as $type)
										<optgroup label="{{ $type->name }}">
											@foreach($type->codes()->active()->get() as $code)<option value="{{ $code->id }}">{{ $code->label }}</option>@endforeach
										</optgroup>
									@endforeach
								</select>
								<span class="input-group-btn">
									<a href="#" class="btn btn-danger legitRipple" @click.prevent="deleteQualificationCode(index, index1)"><i class="icon-cross"></i></a>
								</span>
							</div>
						</template>
						<a href="#" class="btn btn-sm bg-blue-700 btn-add" @click.prevent="addQualificationCode(index)">{{ trans('actions.add') }}</a>
					</td>
					<td class="col-xs-1">
						<a href="#" class="btn btn-xs btn-default" @click.prevent="deleteQualification(index)"><i class="icon-cross2"></i></a>
					</td>
				</tr>
				<tr v-if="qualifications.length > 1 && (index + 1) < qualifications.length" >
					<td colspan="3" class="row">
						<div class="col-xs-1 col-md-offset-4 col-md-4">
							<select v-bind:name="'qualification-codes[' + index + '][join_rule]'" class="form-control" v-model="qualification.join_rule">
								@foreach(trans('qualification-codes.join-rules') as $value => $label)<option value="{{ $value }}">{{ $label }}</option>@endforeach
							</select>
						</div>
					</td>
				</tr>
			</template>
			<tr>
				<td colspan="3" align="center"><a href="#" @click.prevent="addQualification"><i class="icon-plus-circle2"></i> {{ trans('notices.buttons.add-qualification') }}</a></td>
			</tr>
		</tbody>
	</table>
</div>