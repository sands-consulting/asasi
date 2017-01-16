<div role="tabpanel" class="tab-pane" id="vendor-employees">
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th class="col-xs-1">#</th>
				<th>{{ trans('vendors.attributes.employees.name') }}</th>
				<th>{{ trans('vendors.attributes.employees.designation') }}</th>
				<th>{{ trans('vendors.attributes.employees.role') }}</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<template v-for="employee in employees">
			<tr>
				<td>@{{ $index + 1}}</td>
				<td><input type="employees[][name]" class="form-control" v-model="employee.name"></td>
				<td><input type="employees[][identity_number]" class="form-control" v-model="employee.identity_number"></td>
				<td>
					<select name="shareholders[][nationality_id]" class="form-control select2" v-model="shareholder.nationality_id">
						@foreach(trans('vendors.attributes.employees.roles') as $key => $value)
						<option value="{{ $key }}">{{ $value }}</option>
						@endforeach
					</select>
				</td>
				<td>
					<a href="#" class="btn btn-xs btn-danger" @click.prevent="deleteItem(employees, index)">{{ trans('actions.delete') }}</a>
					<input type="hidden" name="employees[][_delete]" v-model="employee._delete">
				</td>
			</tr>
			</template>
			<tr>
				<td colspan="5" align="center"><a href="#" @click.prevent="addEmployee"><i class="icon-plus-circle2"></i> {{ trans('vendors.buttons.add-employee') }}</a></td>
			</tr>
		</tbody>
	</table>
</div>