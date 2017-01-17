<div class="row">
	<div class="col-xs-12 col-md-3 col-md-push-9">
		<div class="panel prompt-box full">
			<h4 class="title">{{ trans('vendors.views._show_details.contact_person.title') }}</h4>
			<p>{{ $vendor->contact_person_designation }} {{ $vendor->contact_person_name }}
				<br>
				<span class="text-muted">
					<i class="icon-mail5"></i> {{ $vendor->contact_person_email }}<br>
					<i class="icon-phone2"></i> {{ $vendor->contact_person_telephone }}
				</span>
			</p>
		</div>

		<div class="panel prompt-box full">
			<h4 class="title">{{ trans('vendors.views._show_details.capital.title') }}</h4>
			<p>{{ trans('vendors.attributes.capital_authorized') }}
				<br>
				<span class="text-muted">{{ $vendor->capital_currency }} {{ $vendor->capital_authorized }}</span>
			</p>
			<p>{{ trans('vendors.attributes.capital_paid_up') }}
				<br>
				<span class="text-muted">{{ $vendor->capital_currency }} {{ $vendor->capital_paid_up }}</span>
			</p>
		</div>
	</div>

	<div class="col-xs-12 col-md-9 col-md-pull-3">
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h6 class="panel-title">{{ trans('vendors.views._show_details.shareholders.title') }}</h6>
			</div>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th class="col-xs-1">#</th>
						<th>{{ trans('vendors.attributes.shareholders.name') }}</th>
						<th>{{ trans('vendors.attributes.shareholders.identity_number') }}</th>
						<th>{{ trans('vendors.attributes.shareholders.nationality') }}</th>
					</tr>
				</thead>
				<tbody>
				<?php $index = 1; ?>
				@forelse($vendor->shareholders()->get() as $shareholder)
					<tr>
						<td>{{ $index }}</td>
						<td>{{ $shareholder->name }}</td>
						<td>{{ $shareholder->identity_number }}</td>
						<td>{{ $shareholder->nationality->name }}</td>
					</tr>
					<?php $index++; ?>
				@empty
					<tr>
						<td colspan="4">{{ trans('vendor.views._show_details.shareholders.empty') }}</td>
					</tr>
				@endforelse
				</tbody>
			</table>
		</div>

		<div class="panel panel-flat">
			<div class="panel-heading">
				<h6 class="panel-title">{{ trans('vendors.views._show_details.employees.title') }}</h6>
			</div>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th class="col-xs-1">#</th>
						<th>{{ trans('vendors.attributes.employees.name') }}</th>
						<th>{{ trans('vendors.attributes.employees.designation') }}</th>
						<th>{{ trans('vendors.attributes.employees.role') }}</th>
					</tr>
				</thead>
				<tbody>
				<?php $index = 1; ?>
				@forelse($vendor->employees()->get() as $employee)
					<tr>
						<td>{{ $index }}</td>
						<td>{{ $employee->name }}</td>
						<td>{{ $employee->designation }}</td>
						<td>{{ trans('vendors.attributes.employees.roles.' . $employee->role) }}</td>
					</tr>
					<?php $index++; ?>
				@empty
					<tr>
						<td colspan="4">{{ trans('vendor.views._show_details.employees.empty') }}</td>
					</tr>
				@endforelse
				</tbody>
			</table>
		</div>

		<div class="panel panel-flat">
			<div class="panel-heading">
				<h6 class="panel-title">{{ trans('vendors.views._show_details.accounts.title') }}</h6>
			</div>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th class="col-xs-1">#</th>
						<th>{{ trans('vendors.attributes.accounts.account_name') }}</th>
						<th>{{ trans('vendors.attributes.accounts.account_number') }}</th>
						<th>{{ trans('vendors.attributes.accounts.bank_name') }}</th>
						<th>{{ trans('vendors.attributes.accounts.bank_iban') }}</th>
						<th>{{ trans('vendors.attributes.accounts.bank_address') }}</th>
					</tr>
				</thead>
				<tbody>
				<?php $index = 1; ?>
				@forelse($vendor->accounts()->get() as $account)
					<tr>
						<td>{{ $index }}</td>
						<td>{{ $account->account_name }}</td>
						<td>{{ $account->account_number }}</td>
						<td>{{ $account->bank_name }}</td>
						<td>{{ $account->bank_iban }}</td>
						<td>{{ $account->bank_address }}</td>
					</tr>
					<?php $index++; ?>
				@empty
					<tr>
						<td colspan="4">{{ trans('vendor.views._show_details.accounts.empty') }}</td>
					</tr>
				@endforelse
				</tbody>
			</table>
		</div>
	</div>
</div>