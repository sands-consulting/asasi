<div role="tabpanel" class="tab-pane" id="tab-vendor-accounts">
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th class="col-xs-1">#</th>
				<th>{{ trans('vendors.attributes.accounts.account_name') }}</th>
				<th>{{ trans('vendors.attributes.accounts.account_number') }}</th>
				<th>{{ trans('vendors.attributes.accounts.bank_name') }}</th>
				<th>{{ trans('vendors.attributes.accounts.bank_iban') }}</th>
				<th width="40">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<tr v-for="(account, index) in accounts">
				<td>@{{ index + 1}}</td>
				<td><input type="text" v-bind:name="'accounts[' + index + '][account_name]'" class="form-control" v-model="account.account_name"></td>
				<td><input type="text" v-bind:name="'accounts[' + index + '][account_number]'" class="form-control" v-model="account.account_number"></td>
				<td><input type="text" v-bind:name="'accounts[' + index + '][bank_name]'" class="form-control" v-model="account.bank_name"></td>
				<td><input type="text" v-bind:name="'accounts[' + index + '][bank_iban]'" class="form-control" v-model="account.bank_iban"></td>
				<td>
					<a href="#" class="btn btn-xs btn-default" @click.prevent="deleteAccount(index)"><i class="icon-cross2"></i></a>
					<input type="hidden" v-bind:name="'accounts[' + index + '][id]'" class="form-control" v-model="account.id">
				</td>
			</tr>
			<tr>
				<td colspan="6" align="center"><a href="#" @click.prevent="addAccount"><i class="icon-plus-circle2"></i> {{ trans('vendors.buttons.add-account') }}</a></td>
			</tr>
		</tbody>
	</table>
</div>