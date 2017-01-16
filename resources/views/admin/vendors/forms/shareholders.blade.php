<div role="tabpanel" class="tab-pane" id="vendor-shareholders">
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th class="col-xs-1">#</th>
				<th>{{ trans('vendors.attributes.shareholders.name') }}</th>
				<th>{{ trans('vendors.attributes.shareholders.identity_number') }}</th>
				<th>{{ trans('vendors.attributes.shareholders.nationality') }}</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<template v-for="shareholder in shareholders">
			<tr>
				<td>@{{ $index + 1}}</td>
				<td><input type="shareholders[][name]" class="form-control" v-model="shareholder.name"></td>
				<td><input type="shareholders[][identity_number]" class="form-control" v-model="shareholder.identity_number"></td>
				<td>
					<select name="shareholders[][nationality_id]" class="form-control select2" v-model="shareholder.nationality_id">
						@foreach(App\Place::type('country')->active()->lists('name', 'id') as $key => $value)
						<option value="{{ $key }}">{{ $value }}</option>
						@endforeach
					</select>
				</td>
				<td>
					<a href="#" class="btn btn-xs btn-danger" @click.prevent="deleteItem(shareholders, index)">{{ trans('actions.delete') }}</a>
					<input type="hidden" name="shareholders[][_delete]" v-model="shareholder._delete">
				</td>
			</tr>
			</template>
			<tr>
				<td colspan="5" align="center"><a href="#" @click.prevent="addShareholder"><i class="icon-plus-circle2"></i> {{ trans('vendors.buttons.add-shareholder') }}</a></td>
			</tr>
		</tbody>
	</table>
</div>