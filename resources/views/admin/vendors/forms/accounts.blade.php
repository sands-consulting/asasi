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
			<tr v-for="account in accounts">
				<td>@{{ $index + 1}}</td>
				<td><input type="text" name="accounts[@{{ $index }}][account_name]" class="form-control" v-model="account.account_name"></td>
				<td><input type="text" name="accounts[@{{ $index }}][account_number]" class="form-control" v-model="account.account_number"></td>
				<td><input type="text" name="accounts[@{{ $index }}][bank_name]" class="form-control" v-model="account.bank_name"></td>
				<td><input type="text" name="accounts[@{{ $index }}][bank_iban]" class="form-control" v-model="account.bank_iban"></td>
				<td><input type="text" name="accounts[@{{ $index }}][bank_address]" class="form-control" v-model="account.bank_address"></td>
				<td>
					<a href="#" class="btn btn-xs btn-danger" @click.prevent="deleteItem(accounts, index)">{{ trans('actions.delete') }}</a>
					<input type="hidden" name="accounts[@{{ $index }}][id]" class="form-control" v-model="account.id">
				</td>
			</tr>
			<tr>
				<td colspan="7" align="center"><a href="#" @click.prevent="addEmployee"><i class="icon-plus-circle2"></i> {{ trans('vendors.buttons.add-account') }}</a></td>
			</tr>
		</tbody>
	</table>
</div>