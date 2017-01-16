<div role="tabpanel" class="tab-pane" id="vendor-accounts">
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th class="col-xs-1">#</th>
				<th>{{ trans('vendors.attributes.accounts.account_name') }}</th>
				<th>{{ trans('vendors.attributes.accounts.account_number') }}</th>
				<th>{{ trans('vendors.attributes.accounts.bank_name') }}</th>
				<th>{{ trans('vendors.attributes.accounts.bank_iban') }}</th>
				<th>{{ trans('vendors.attributes.accounts.bank_address') }}</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<template v-for="account in accounts">
			<tr>
				<td>@{{ $index + 1}}</td>
				<td><input type="accounts[][name]" class="form-control" v-model="account.name"></td>
				<td><input type="accounts[][identity_number]" class="form-control" v-model="account.identity_number"></td>
				<td>
					<select name="shareholders[][nationality_id]" class="form-control select2" v-model="shareholder.nationality_id">
						@foreach(trans('vendors.attributes.employees.roles') as $key => $value)
						<option value="{{ $key }}">{{ $value }}</option>
						@endforeach
					</select>
				</td>
				<td>
					<a href="#" class="btn btn-xs btn-danger" @click.prevent="deleteItem(accounts, index)">{{ trans('actions.delete') }}</a>
				</td>
			</tr>
			</template>
			<tr>
				<td colspan="7" align="center"><a href="#" @click.prevent="addEmployee"><i class="icon-plus-circle2"></i> {{ trans('vendors.buttons.add-account') }}</a></td>
			</tr>
		</tbody>
	</table>
</div>