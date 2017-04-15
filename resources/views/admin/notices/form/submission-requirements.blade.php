<div role="tabpanel" class="tab-pane" id="tab-notice-submission-requirements">
	<table class="table table-bordered table-striped table-vtop">
		@foreach(App\EvaluationType::active()->get() as $type)
		<thead>
			<tr class="bg-blue-700">
				<th colspan="5">{{ $type->name }}</th>
			</tr>
			<tr>
				<th class="col-xs-1">#</th>
				<th>{{ trans('notices.attributes.submission-requirements.title') }}</th>
				<th>{{ trans('notices.attributes.submission-requirements.field') }}</th>
				<th width="50">{{ trans('notices.attributes.submission-requirements.required') }}</th>
				<th width="40">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<tr v-for="(requirement, index) in submissionRequirements['{{ $type->slug }}']">
				<td>@{{ index + 1}}</td>
				<td><input type="text" v-bind:name="'submission-requirements[{{ $type->slug }}][' + index + '][title]'" class="form-control" v-model="requirement.title"></td>
				<td>
					<select v-bind:name="'submission-requirements[{{ $type->slug }}][' + index + '][field_type]'" class="form-control" v-model="requirement.field_type">
						@foreach(trans('notices.field-types') as $key => $value)<option value="{{ $key }}">{{ $value }}</option>@endforeach
					</select>
				</td>
				<td>
					<input type="hidden" v-bind:name="'submission-requirements[{{ $type->slug }}][' + index + '][field_required]'" value="0">
					<input type="checkbox" v-bind:name="'submission-requirements[{{ $type->slug }}][' + index + '][field_required]'" v-bind:checked="requirement.field_required" value="1">
				</td>
				<td>
					<a href="#" class="btn btn-xs btn-default" @click.prevent="deleteSubmissionRequirement('{{ $type->slug }}', index)"><i class="icon-cross2"></i></a>
					<input type="hidden" v-bind:name="'submission-requirements[{{ $type->slug }}][' + index + '][id]'" class="form-control" v-model="requirement.id">
				</td>
			</tr>
			<tr>
				<td colspan="5" align="center"><a href="#" @click.prevent="addSubmissionRequirement('{{ $type->slug }}')"><i class="icon-plus-circle2"></i> {{ trans('notices.buttons.add-requirement') }}</a></td>
			</tr>
		</tbody>
		@endforeach
	</table>
</div>