<div role="tabpanel" class="tab-pane" id="tab-notice-allocations">
	<table class="table table-bordered table-striped table-vtop">
		<thead>
			<tr>
				<th class="col-xs-1">#</th>
				<th>{{ trans('notices.attributes.allocations.allocation') }}</th>
				<th>{{ trans('notices.attributes.allocations.amount') }}</th>
				<th width="40">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<tr v-for="(allocation, index) in allocations">
				<td>@{{ index + 1}}</td>
				<td>
					<select v-bind:name="'allocations[' + index + '][id]'" class="form-control" v-model="allocation.id">
						<option value="" selected disabled>{{ trans('notices.views.admin.form.allocations.select') }}</option>
						@foreach(App\Allocation::options() as $key => $value)<option value="{{ $value }}">{{ $key }}</option>@endforeach
					</select>
				</td>
				<td>
					<div class="input-group">
						<span class="input-group-addon">{{ setting('currency') }}</span>
						<input type="text" v-bind:name="'allocations[' + index + '][amount]'" class="form-control" v-model="allocation.name">
					</div>
				</td>
				<td><a href="#" class="btn btn-xs btn-default" @click.prevent="deleteAllocation(index)"><i class="icon-cross2"></i></a></td>
			</tr>
			<tr>
				<td colspan="6" align="center"><a href="#" @click.prevent="addAllocation"><i class="icon-plus-circle2"></i> {{ trans('notices.buttons.add-allocation') }}</a></td>
			</tr>
		</tbody>
	</table>
</div>