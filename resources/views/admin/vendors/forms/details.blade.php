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
				->options(App\VendorType::active()->get()->pluck('label', 'id'))
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
			<div class="row">
				<div class="col-xs-12 col-md-4">
					{!! Former::text('address_postcode')
						->label(null)
						->placeholder('vendors.attributes.address_postcode') !!}
				</div>
				<div class="col-xs-12 col-md-8">
					{!! Former::select('address_city_id')
						->label(null)
						->placeholder('vendors.attributes.address_city_id')
						->options(App\Place::type('city')->active()->pluck('name', 'id'))
						->addClass('select2') !!}
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-md-6">
					{!! Former::select('address_state_id')
						->label(null)
						->placeholder('vendors.attributes.address_state_id')
						->options(App\Place::type('state')->active()->pluck('name', 'id'))
						->addClass('select2') !!}
				</div>
				<div class="col-xs-12 col-md-6">
					{!! Former::select('address_country_id')
						->label(null)
						->placeholder('vendors.attributes.address_country_id')
						->options(App\Place::type('country')->active()->pluck('name', 'id'))
						->addClass('select2') !!}
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