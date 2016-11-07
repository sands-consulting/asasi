<div class="panel-body">
	<div class="row">
		<div class="col-xs-12 col-md-3">
			<ul class="nav nav-pills nav-stacked" role="tablist">
				<li role="presentation" class="active">
					<a href="#vendor-details" aria-controls="vendor-details" role="tab" v-on:click="show">
						<i class=" icon-file-text"></i> {{ trans('vendors.views._form.nav.details') }}
					</a>
				</li>
				<li role="presentation">
					<a href="#vendor-contact" aria-controls="vendor-contact" role="tab" v-on:click="show">
						<i class="icon-user-tie"></i> {{ trans('vendors.views._form.nav.contact') }}
					</a>
				</li>
				<li role="presentation">
					<a href="#vendor-qualification-codes" aria-controls="vendor-qualification-codes" role="tab" v-on:click="show">
						<i class="icon-folder-check"></i> {{ trans('vendors.views._form.nav.qualification_codes') }}
					</a>
				</li>
				<li role="presentation">
					<a href="#vendor-shareholders" aria-controls="vendor-shareholders" role="tab" v-on:click="show">
						<i class="icon-portfolio"></i> {{ trans('vendors.views._form.nav.shareholders') }}
					</a>
				</li>
				<li role="presentation">
					<a href="#vendor-employees" aria-controls="vendor-employees" role="tab" v-on:click="show">
						<i class="icon-users4"></i> {{ trans('vendors.views._form.nav.employees') }}
					</a>
				</li>
				<li role="presentation">
					<a href="#vendor-accounts" aria-controls="vendor-accounts" role="tab" v-on:click="show">
						<i class="icon-database4"></i> {{ trans('vendors.views._form.nav.accounts') }}
					</a>
				</li>
				<li role="presentation">
					<a href="#vendor-files" aria-controls="vendor-files" role="tab" v-on:click="show">
						<i class="icon-stack"></i> {{ trans('vendors.views._form.nav.files') }}
					</a>
				</li>
			</ul>
		</div>

		<div class="col-xs-12 col-md-9">
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="vendor-details">
					<div class="row">
						<div class="col-xs-12 col-md-3">
							{!! Former::text('registration_number')
								->label('vendors.attributes.registration_number')
								->disabled() !!}
						</div>
						<div class="col-xs-12 col-md-9">
							{!! Former::text('name')
								->required() !!}
						</div>
					</div>

					<div class="row">
						<div class="col-xs-12 col-md-6">
							{!! Former::select('type_id')
								->label('vendors.attributes.type_id')
								->options(App\VendorType::active()->get()->lists('label', 'id'))
								->required()
								->addClass('select2') !!}
						</div>
						<div class="col-xs-12 col-md-3">
							{!! Former::text('tax_1_number')
								->label('vendors.attributes.tax_1_number') !!}
						</div>
						<div class="col-xs-12 col-md-3">
							{!! Former::text('tax_2_number')
								->label('vendors.attributes.tax_2_number') !!}
						</div>
					</div>

					<div class="row">
						<div class="col-xs-12 col-md-6">
							{!! Former::select('capital_currency')
								->label('vendors.attributes.capital_currency')
								->options(['MYR' => 'Malaysian Ringgit'])
								->required()
								->addClass('select2') !!}
						</div>
						<div class="col-xs-12 col-md-3">
							{!! Former::text('capital_authorized')
								->label('vendors.attributes.capital_authorized')
								->required() !!}
						</div>
						<div class="col-xs-12 col-md-3">
							{!! Former::text('capital_paid_up')
								->label('vendors.attributes.capital_paid_up')
								->required() !!}
						</div>
					</div>

					<div class="row">
						<div class="col-xs-12 col-md-6 address">
							{!! Former::text('address_1')
								->label('vendors.attributes.address')
								->placeholder('vendors.attributes.address_1') !!}
							{!! Former::text('address_2')
								->label(null)
								->placeholder('vendors.attributes.address_2') !!}
							{!! Former::select('address_city_id')
								->label(null)
								->placeholder('vendors.attributes.address_city_id')
								->options(App\Place::type('city')->active()->lists('name', 'id'))
								->addClass('select2') !!}
							<div class="row">
								<div class="col-xs-12 col-md-4">
									{!! Former::text('address_postcode')
										->label(null)
										->placeholder('vendors.attributes.address_postcode') !!}
								</div>
								<div class="col-xs-12 col-md-8">
									{!! Former::select('address_state_id')
										->label(null)
										->placeholder('vendors.attributes.address_state_id')
										->options(App\Place::type('state')->active()->lists('name', 'id'))
										->addClass('select2') !!}
								</div>
							</div>
							{!! Former::select('address_country_id')
								->label(null)
								->placeholder('vendors.attributes.address_country_id')
								->options(App\Place::type('country')->active()->lists('name', 'id'))
								->addClass('select2') !!}
						</div>

						<div class="col-xs-12 col-md-6">
							<div class="row">
								<div class="col-xs-12 col-md-6">
									{!! Former::text('contact_telephone')
										->label('vendors.attributes.contact_telephone')
										->required() !!}
								</div>

								<div class="col-xs-12 col-md-6">
									{!! Former::text('contact_fax')
										->label('vendors.attributes.contact_fax')
										->required() !!}
								</div>
							</div>

							{!! Former::text('contact_email')
								->label('vendors.attributes.contact_email')
								->required() !!}
							{!! Former::text('contact_website')
								->label('vendors.attributes.contact_website')
								->required() !!}
						</div>
					</div>
				</div>

				<div role="tabpanel" class="tab-pane" id="vendor-contact">
					<div class="row">
						<div class="col-xs-12 col-md-2">
							{!! Former::select('contact_person_designation')
								->label('vendors.attributes.contact_person_designation')
								->options(['Mr' => 'Mr', 'Ms' => 'Ms'])
								->required()
								->addClass('select2') !!}
						</div>
						<div class="col-xs-12 col-md-10">
							{!! Former::text('contact_person_name')
								->label('vendors.attributes.contact_person_name') !!}
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-md-6">
							{!! Former::text('contact_person_telephone')
								->label('vendors.attributes.contact_person_telephone') !!}
						</div>
						<div class="col-xs-12 col-md-6">
							{!! Former::text('contact_person_email')
								->label('vendors.attributes.contact_person_email') !!}
						</div>
					</div>
				</div>

				<div role="tabpanel" class="tab-pane" id="vendor-qualification-codes">
					Vendor Qualification Codes
				</div>

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
								<td>@{{ index + 1}}</td>
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
									<a href="#" class="btn btn-xs btn-danger" v-on:click="setDelete(shareholder)">{{ trans('actions.delete') }}</a>
									<input type="hidden" name="shareholders[][_delete]" v-model="shareholder._delete">
								</td>
							</tr>
							</template>
							<tr>
								<td colspan="5" align="center"><a href="#" v-on:click="addShareholder"><i class="icon-plus-circle2"></i> {{ trans('vendors.buttons.add-shareholder') }}</a></td>
							</tr>
						</tbody>
					</table>
				</div>
			
				<div role="tabpanel" class="tab-pane" id="vendor-employees">
					Vendor Employees
				</div>

				<div role="tabpanel" class="tab-pane" id="vendor-accounts">
					Vendor Accounts
				</div>
			
				<div role="tabpanel" class="tab-pane" id="vendor-files">
					Vendor Files
				</div>
			</div>
		</div>
	</div>
</div>
