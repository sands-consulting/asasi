<div role="tabpanel" class="panel-body tab-pane active" id="tab-vendor-details">
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
				->options(['' => ''] + App\VendorType::active()->get()->pluck('label', 'id')->toArray())
				->required()
				->addClass('vue-select2') !!}
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
				->options(['' => ''] + ['MYR' => 'Malaysian Ringgit'])
				->addClass('vue-select2') !!}
		</div>
		<div class="col-xs-12 col-md-3">
			{!! Former::text('capital_authorized')
				->label('vendors.attributes.capital_authorized') !!}
		</div>
		<div class="col-xs-12 col-md-3">
			{!! Former::text('capital_paid_up')
				->label('vendors.attributes.capital_paid_up') !!}
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-md-6 address">
			{!! Former::text('address[line_one]')
				->label('vendors.attributes.address')
				->placeholder('vendors.attributes.address_1')
				->addAttribute('v-model', 'address.line_one') !!}
			{!! Former::text('address[line_two]')
				->label(null)
				->placeholder('vendors.attributes.address_2')
				->addAttribute('v-model', 'address.line_two') !!}
			<div class="row">
				<div class="col-xs-12 col-md-6">
					<select id="address[country_id]" name="address[country_id]" class="form-control" v-model="address.country_id">
						<option value="" selected="selected" disabled>{{ trans('vendors.attributes.address_country_id') }}</option>
						<option v-for="option in countries" v-bind:value="option.id">@{{ option.name }}</option>
					</select>
				</div>
				<div class="col-xs-12 col-md-6">
					<select id="address[state_id]" name="address[state_id]" class="form-control" v-model="address.state_id">
						<option value="" selected="selected" disabled>{{ trans('vendors.attributes.address_state_id') }}</option>
						<option v-for="option in states" v-bind:value="option.id">@{{ option.name }}</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-md-4">
					{!! Former::text('address[postcode]')
						->label(null)
						->placeholder('vendors.attributes.address_postcode')
						->addAttribute('v-model', 'address.postcode') !!}
				</div>
				<div class="col-xs-12 col-md-8">
					<select id="address[city_id]" name="address[city_id]" class="form-control" v-model="address.city_id">
						<option value="" selected="selected" disabled>{{ trans('vendors.attributes.address_city_id') }}</option>
						<option v-for="option in cities" v-bind:value="option.id">@{{ option.name }}</option>
					</select>
				</div>
			</div>
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
						->label('vendors.attributes.contact_fax') !!}
				</div>
			</div>

			{!! Former::text('contact_email')
				->label('vendors.attributes.contact_email')
				->required() !!}
			{!! Former::text('contact_website')
				->label('vendors.attributes.contact_website') !!}
		</div>
	</div>
</div>