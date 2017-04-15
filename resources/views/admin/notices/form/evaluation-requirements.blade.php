<div role="tabpanel" class="tab-pane" id="tab-notice-evaluation-requirements">
	<table class="table table-bordered table-striped table-vtop">
		@foreach(App\EvaluationType::active()->get() as $type)
		<thead>
			<tr class="bg-blue-700">
				<th colspan="5">{{ $type->name }}</th>
			</tr>
			<tr>
				<th class="col-xs-1">#</th>
				<th>{{ trans('notices.attributes.evaluation-requirements.title') }}</th>
				<th>{{ trans('notices.attributes.evaluation-requirements.full_score') }}</th>
				<th width="40">{{ trans('notices.attributes.evaluation-requirements.required') }}</th>
				<th width="40">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<tr v-for="(requirement, index) in evaluationRequirements['{{ $type->slug }}']">
				<td>@{{ index + 1}}</td>
				<td><input type="text" v-bind:name="'evaluation-requirements[{{ $type->slug }}][' + index + '][title]'" class="form-control" v-model="requirement.title"></td>
				<td><input type="text" v-bind:name="'evaluation-requirements[{{ $type->slug }}][' + index + '][full_score]'" class="form-control" v-model="requirement.full_score"></td>
				<td>
					<input type="hidden" v-bind:name="'evaluation-requirements[{{ $type->slug }}][' + index + '][required]'" value="0">
					<input type="checkbox" v-bind:name="'evaluation-requirements[{{ $type->slug }}][' + index + '][required]'" v-model="requirement.required" value="1">
				</td>
				<td>
					<a href="#" class="btn btn-xs btn-default" @click.prevent="deleteEvaluationRequirement('{{ $type->slug }}', index)"><i class="icon-cross2"></i></a>
					<input type="hidden" v-bind:name="'evaluation-requirements[{{ $type->slug }}][' + index + '][id]'" class="form-control" v-model="requirement.id">
				</td>
			</tr>
			<tr>
				<td colspan="5" align="center"><a href="#" @click.prevent="addEvaluationRequirement('{{ $type->slug }}')"><i class="icon-plus-circle2"></i> {{ trans('notices.buttons.add-requirement') }}</a></td>
			</tr>
		</tbody>
		@endforeach
	</table>
</div>